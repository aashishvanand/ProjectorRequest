package com.aashish.projectorrequest;

import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.preference.PreferenceManager;
import android.renderscript.Sampler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.codetroopers.betterpickers.calendardatepicker.CalendarDatePickerDialogFragment;
import com.wdullaer.materialdatetimepicker.date.DatePickerDialog;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

import fr.ganfra.materialspinner.MaterialSpinner;



public class Request extends AppCompatActivity  {


    private SharedPreferences prefsPrivate;
    java.sql.Time timeValue;
    SimpleDateFormat format;
    Calendar c;
    int year, month, day;
    SimpleDateFormat formatter;

    private Calendar calendar;
    private EditText dateView;

    private ProgressDialog pDialog;
    EditText date1, hour, projector;
    EditText staffcode;
    MaterialSpinner spinner, spinner1;
    String[] period = {"1", "2", "3", "4", "5", "6", "7", "8"};
    String[] project = {"canon", "dell", "epson", "hp", "hitachi"};
    Button submit;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_request);
        c = Calendar.getInstance();
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        prefsPrivate = getSharedPreferences(Login.PREFS_PRIVATE, Context.MODE_PRIVATE);
       staffcode = (EditText) findViewById(R.id.staffcode);

        staffcode.setText(prefsPrivate.getString(Login.KEY_PRIVATE, "NA"));

        year = c.get(Calendar.YEAR);
        month = c.get(Calendar.MONTH);
        day = c.get(Calendar.DAY_OF_MONTH);
        date1 = (EditText) findViewById(R.id.date);
        submit = (Button) findViewById(R.id.submit);
        final ArrayAdapter<String> adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, period);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> adapter1 = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, project);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        spinner = (MaterialSpinner) findViewById(R.id.spinner);
        spinner1 = (MaterialSpinner) findViewById(R.id.spinner1);
        spinner1.setAdapter(adapter1);
        spinner.setAdapter(adapter);
        spinner.setHint("Select period");
        spinner1.setHint("Select projector");



        // Create an ArrayAdapter using the string array and a default spinner
        ArrayAdapter<CharSequence> staticAdapter = ArrayAdapter
                .createFromResource(getApplication(), R.array.period,
                        android.R.layout.simple_spinner_item);
        ArrayAdapter<CharSequence> staticAdapter1 = ArrayAdapter
                .createFromResource(getApplication(), R.array.project,
                        android.R.layout.simple_spinner_item);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                requestdata();
                Intent i =new Intent(Request.this,MainActivity.class);
                startActivity(i);
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

                            date1.setText(formatter.format(date).toString());
                        } catch (Exception ex) {
                            date1.setText(ex.getMessage().toString());
                        }
                    }
                });
            }
        });


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
                        Toast.makeText(Request.this, "Success make intent to main activity", Toast.LENGTH_SHORT).show();

                    } else {
                        // Error in login. Get the error message
                        Toast.makeText(getApplicationContext(),
                                "Data not found!", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), "Unknown Error", Toast.LENGTH_LONG).show();
                }

            }
        }, new com.android.volley.Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {

                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<>();
                params.put("date", date1.getText().toString());
                params.put("hour", spinner.getSelectedItem().toString());
                params.put("staffcode", staffcode.getText().toString());
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
