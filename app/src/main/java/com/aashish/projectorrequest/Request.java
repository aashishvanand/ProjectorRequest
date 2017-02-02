package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.codetroopers.betterpickers.calendardatepicker.CalendarDatePickerDialogFragment;
import com.codetroopers.betterpickers.calendardatepicker.MonthAdapter;

import org.joda.time.DateTime;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import fr.ganfra.materialspinner.MaterialSpinner;


public class Request extends AppCompatActivity {

    public static final String PREF = "Projectrequest";
    Calendar calendar;
    int year, month, day;
    SimpleDateFormat formatter;
    String code, dept_pref;
    EditText date1;
    MaterialSpinner period_spinner, projector_spinner, year_spinner, department_spinner, section_spinner;
    String[] period_array = {"1", "2", "3", "4", "5", "6", "7", "8"};
    String[] year_array = {"I", "II", "III", "IV"};
    String[] department_array = {"AERO", "AUTO", "BTECH", "BMED", "CHEM", "CIVIL", "CSE", "EEE", "ECE", "IT", "MECH", "MTRCS", "HS", "PE", "EDC", "MBA", "MCA"};
    String[] section_array = {"A", "B", "C", "D"};
    //String[] projector_array = {"Projector 1 - Canon", "Projector 2 - Dell", "Projector 3 - Epson", "Projector 4 - Hp", "Projector 5 - Hitachi"};
    Button submit;
    Snackbar SnackbarRequest;
    CoordinatorLayout coordinatorLayoutRequest;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_request);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        coordinatorLayoutRequest = (CoordinatorLayout) findViewById(R.id.coordinatorLayoutRequest);
        calendar = Calendar.getInstance();
        SharedPreferences prefs = getSharedPreferences(PREF, MODE_PRIVATE);
        code = prefs.getString("code", null);
        dept_pref = prefs.getString("dept", null);

        final ArrayAdapter<String> period_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, period_array);
        period_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> projector_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, MainActivity.dept_projector);
        projector_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> year_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, year_array);
        year_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> dept_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, department_array);
        dept_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        final ArrayAdapter<String> section_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, section_array);
        section_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        period_spinner = (MaterialSpinner) findViewById(R.id.spinner_period);
        period_spinner.setHint(getResources().getString(R.string.select_hour));
        period_spinner.setAdapter(period_adapter);

        projector_spinner = (MaterialSpinner) findViewById(R.id.spinner_projector);
        projector_spinner.setHint(getResources().getString(R.string.select_projector));
        projector_spinner.setAdapter(projector_adapter);

        year_spinner = (MaterialSpinner) findViewById(R.id.spinner_year);
        year_spinner.setHint(getResources().getString(R.string.select_year));
        year_spinner.setAdapter(year_adapter);

        department_spinner = (MaterialSpinner) findViewById(R.id.spinner_department);
        department_spinner.setHint(getResources().getString(R.string.select_dept));
        department_spinner.setAdapter(dept_adapter);

        section_spinner = (MaterialSpinner) findViewById(R.id.spinner_section);
        section_spinner.setAdapter(section_adapter);
        section_spinner.setHint(getResources().getString(R.string.select_section));

        year = calendar.get(Calendar.YEAR);
        month = calendar.get(Calendar.MONTH);
        day = calendar.get(Calendar.DAY_OF_MONTH);
        date1 = (EditText) findViewById(R.id.date);
        submit = (Button) findViewById(R.id.submit);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                String period = period_spinner.getSelectedItem().toString();
                String department = department_spinner.getSelectedItem().toString();
                String year = year_spinner.getSelectedItem().toString();
                String section = section_spinner.getSelectedItem().toString();
                String projector = projector_spinner.getSelectedItem().toString();

                if (period.equalsIgnoreCase(getResources().getString(R.string.select_hour)) || projector.equalsIgnoreCase(getResources().getString(R.string.select_projector)) || department.equalsIgnoreCase(getResources().getString(R.string.select_dept)) || section.equalsIgnoreCase(getResources().getString(R.string.select_section)) || year.equalsIgnoreCase(getResources().getString(R.string.select_year)) || date1.equals("")) {

                    if (period.equalsIgnoreCase(getResources().getString(R.string.select_hour))) {
                        period_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }

                    if (period.equalsIgnoreCase(getResources().getString(R.string.select_projector))) {
                        period_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }

                    if (period.equalsIgnoreCase(getResources().getString(R.string.select_dept))) {
                        period_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }

                    if (period.equalsIgnoreCase(getResources().getString(R.string.select_section))) {
                        period_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }

                    if (period.equalsIgnoreCase(getResources().getString(R.string.select_year))) {
                        period_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }


                    SnackbarRequest = Snackbar
                            .make(coordinatorLayoutRequest, getResources().getString(R.string.check_selection), Snackbar.LENGTH_SHORT);
                    SnackbarRequest.show();
                } else {
                    requestData(period, projector, department, year, section);
                }
            }
        });

        date1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DateTime now = DateTime.now();
                MonthAdapter.CalendarDay minDate = new MonthAdapter.CalendarDay(now.getYear(), now.getMonthOfYear() - 1, now.getDayOfMonth());
                CalendarDatePickerDialogFragment cdp = new CalendarDatePickerDialogFragment();
                cdp.show(Request.this.getSupportFragmentManager(), "Calender");
                cdp.setDateRange(minDate, null);

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

    private void requestData(final String period, final String projector, final String dept, final String YEar, final String sec) {
        // Tag used to cancel the request
        String tag_string_req = "req_proj";
        pDialog.setMessage("Requesting Projector");
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
                                .make(coordinatorLayoutRequest, getResources().getString(R.string.booked_successfully), Snackbar.LENGTH_SHORT);
                        SnackbarRequest.show();
                        Intent i = new Intent(Request.this, MainActivity.class);
                        startActivity(i);
                        finish();

                    } else {
                        String errorMsg = jObj.getString("error_msg");
                        SnackbarRequest = Snackbar
                                .make(coordinatorLayoutRequest, errorMsg, Snackbar.LENGTH_SHORT);
                        SnackbarRequest.show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    SnackbarRequest = Snackbar
                            .make(coordinatorLayoutRequest, getString(R.string.unknown_error), Snackbar.LENGTH_SHORT);
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
                params.put("hour", period);
                params.put("staffcode", code);
                params.put("projector", projector);
                params.put("department", dept);
                params.put("year", YEar);
                params.put("section", sec);
                params.put("dept", dept_pref);


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

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.delete) {
            Intent i = new Intent(Request.this, DeleteRequest.class);
            startActivity(i);
            return true;
        }

        if (id == R.id.logout) {
            Intent i = new Intent(Request.this, Login.class);
            startActivity(i);
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

}
