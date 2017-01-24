package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.codetroopers.betterpickers.calendardatepicker.CalendarDatePickerDialogFragment;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import fr.ganfra.materialspinner.MaterialSpinner;


public class Request extends AppCompatActivity  {

    Calendar c;
    int year, month, day;
    SimpleDateFormat formatter;
    String code;
    private ProgressDialog pDialog;
    EditText date1;
    MaterialSpinner spinner, spinner1,YEAR,DEPT,SEC;
    String[] period = {"1", "2", "3", "4", "5", "6", "7", "8"};
    String[] YEar = {"1","2","3","4"};
    String[] DEpt = {"CSE","MECH"};
    String[] SEc = {"A","B","C","D"};
    String[] project = {"Canon", "Dell", "Epson", "Hp", "Hitachi","ViewSonic"};
    Button submit;
    Snackbar SnackbarRequest;
    public static final String PREF = "Projectrequest";
    CoordinatorLayout coordinatorLayoutRequest;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_request);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        coordinatorLayoutRequest = (CoordinatorLayout) findViewById(R.id.coordinatorLayoutRequest);
        c = Calendar.getInstance();
        SharedPreferences prefs = getSharedPreferences(PREF, MODE_PRIVATE);
        code = prefs.getString("code", null);
        final ArrayAdapter<String> adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, period);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, project);
        adapter1.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> Year = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item,YEar);
        Year.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> dept = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, DEpt);
        dept.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> sec = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, SEc);
        sec.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner = (MaterialSpinner) findViewById(R.id.spinner);
        YEAR = (MaterialSpinner) findViewById(R.id.year);
        DEPT = (MaterialSpinner) findViewById(R.id.dept);
        SEC = (MaterialSpinner) findViewById(R.id.sec);
        spinner1 = (MaterialSpinner) findViewById(R.id.spinner1);
        spinner1.setAdapter(adapter1);
        spinner.setAdapter(adapter);
        YEAR.setAdapter(Year);
        DEPT.setAdapter(dept);
        SEC.setAdapter(sec);
        spinner.setHint("Select period");
        YEAR.setHint("Select Year");
        DEPT.setHint("Select Dept");
        SEC.setHint("Select Section");
        spinner1.setHint("Select projector");
        year = c.get(Calendar.YEAR);
        month = c.get(Calendar.MONTH);
        day = c.get(Calendar.DAY_OF_MONTH);
        date1 = (EditText) findViewById(R.id.date);
        submit = (Button) findViewById(R.id.submit);


        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Calendar calendar = Calendar.getInstance();
                SimpleDateFormat mdformat = new SimpleDateFormat("yyyy / MM / dd ");
                String strDate = mdformat.format(calendar.getTime());
                Date today = calendar.getTime();
                try {
                    Date current_date = formatter.parse(strDate);
                    Date user_date = formatter.parse(String.valueOf(date1));
                    if(today.compareTo(user_date)>0){
                        Toast.makeText(getApplicationContext(),"OUT",Toast.LENGTH_SHORT).show();
                    }
                } catch (ParseException e) {
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(),"OUTING",Toast.LENGTH_SHORT).show();
                }


                String period = spinner.getSelectedItem().toString();
                String dept = DEPT.getSelectedItem().toString();
                String YEar = YEAR.getSelectedItem().toString();
                String Sec = SEC.getSelectedItem().toString();
                String projector = spinner1.getSelectedItem().toString();
                if (period.equalsIgnoreCase("Select period") ||projector.equalsIgnoreCase("Select projector") || dept.equalsIgnoreCase("Select Dept")|| Sec.equalsIgnoreCase("Select Section")||YEar.equalsIgnoreCase("Select Year")||date1.equals("")) {
                    SnackbarRequest = Snackbar
                            .make(coordinatorLayoutRequest, "Select Period,Select Projector,Select year,Select Dept and Select Section", Snackbar.LENGTH_SHORT);
                    SnackbarRequest.show();
                }
                else {
                    requestdata();
                }

                //do validation here for the values
                //check for date cannot make request for previous date
                //check for all other fields for null and correct values and fix it before calling request data function

            }
        });

        date1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Get Current Date
                CalendarDatePickerDialogFragment cdp = new CalendarDatePickerDialogFragment();
                cdp.show(Request.this.getSupportFragmentManager(), "Material Calendar Example");
                cdp.setOnDateSetListener(new CalendarDatePickerDialogFragment.OnDateSetListener() {
                    @Override
                    public void onDateSet(CalendarDatePickerDialogFragment dialog, int year, int monthOfYear, int dayOfMonth) {
                        try {
                            formatter = new SimpleDateFormat("yyyy-MM-dd");
                            String dateInString = year + "-" + (monthOfYear + 1) + "-" + dayOfMonth;
                            Date date = formatter.parse(dateInString);

                            date1.setText(formatter.format(date));
                        } catch (Exception ex) {
                            date1.setText(ex.getMessage());
                        }
                    }
                });
            }
        });


    }
    public void getCurrentDate(View view) {
        Calendar calendar = Calendar.getInstance();
        SimpleDateFormat mdformat = new SimpleDateFormat("yyyy / MM / dd ");
        String strDate = mdformat.format(calendar.getTime());
    }

    private void requestdata() {
        // Tag used to cancel the request
        String tag_string_req = "get_data";
        pDialog.setMessage("Get Data");
        showDialog();

        final StringRequest strReq = new StringRequest(com.android.volley.Request.Method.POST,
                BuildConfig.URL_request, new com.android.volley.Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    // Check for error node in json
                    if (!error) {
                        SnackbarRequest = Snackbar
                                .make(coordinatorLayoutRequest, "Registered Successfully", Snackbar.LENGTH_SHORT);
                        SnackbarRequest.show();
                        Intent i =new Intent(Request.this,MainActivity.class);
                        startActivity(i);

                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                        SnackbarRequest = Snackbar
                                .make(coordinatorLayoutRequest, errorMsg, Snackbar.LENGTH_SHORT);
                        SnackbarRequest.show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                    SnackbarRequest = Snackbar
                            .make(coordinatorLayoutRequest, getString(R.string.wrong_user_or_password_combination), Snackbar.LENGTH_SHORT);
                    SnackbarRequest.show();
                }

            }
        }, new com.android.volley.Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {

                SnackbarRequest = Snackbar
                        .make(coordinatorLayoutRequest, error.getMessage(), Snackbar.LENGTH_SHORT);
                SnackbarRequest.show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<>();
                params.put("date", date1.getText().toString());
                params.put("hour", spinner.getSelectedItem().toString());
                //params.put("staffcode", code);
                params.put("staffcode", "cs11");
                params.put("projector", spinner1.getSelectedItem().toString());

                return params;
            }
        };
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }


}
