package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.codetroopers.betterpickers.calendardatepicker.CalendarDatePickerDialogFragment;
import com.codetroopers.betterpickers.calendardatepicker.MonthAdapter;

import org.joda.time.DateTime;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import fr.ganfra.materialspinner.MaterialSpinner;

public class DeleteRequest extends AppCompatActivity {

    public static final String PREF = "Projectrequest";
    String code, dept;
    MaterialSpinner date_spinner, hour_spinner,  projector_spinner;
    static ArrayList<String> date_array = new ArrayList<String>();
    static ArrayList<String> hour_array = new ArrayList<String>();
    static ArrayList<String> projector_array = new ArrayList<String>();
    Button submit;
    Snackbar SnackbarDelete;
    CoordinatorLayout coordinatorLayoutDelete;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_delete_request);

        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        coordinatorLayoutDelete = (CoordinatorLayout) findViewById(R.id.coordinatorLayoutDelete);

        SharedPreferences prefs = getSharedPreferences(PREF, MODE_PRIVATE);
        code = prefs.getString("code", null);
        dept = prefs.getString("dept", null);

        cancelData(code);

        final ArrayAdapter<String> date_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, date_array);
        date_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        date_spinner = (MaterialSpinner) findViewById(R.id.date_spinner);
        date_spinner.setAdapter(date_adapter);
        date_spinner.setHint(getResources().getString(R.string.select_date));

        final ArrayAdapter<String> hour_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, hour_array);
        hour_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        hour_spinner = (MaterialSpinner) findViewById(R.id.hour_spinner);
        hour_spinner.setAdapter(hour_adapter);
        hour_spinner.setHint(getResources().getString(R.string.select_hour));

        final ArrayAdapter<String> projector_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, projector_array);
        projector_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        projector_spinner = (MaterialSpinner) findViewById(R.id.projector_spinner);
        projector_spinner.setAdapter(projector_adapter);
        projector_spinner.setHint(getResources().getString(R.string.select_projector));

        submit = (Button) findViewById(R.id.submit);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String date = date_spinner.getSelectedItem().toString();
                String hour = hour_spinner.getSelectedItem().toString();
                String projector = projector_spinner.getSelectedItem().toString();

                if (hour.equalsIgnoreCase(getResources().getString(R.string.select_hour)) || projector.equalsIgnoreCase(getResources().getString(R.string.select_projector)) || date.equalsIgnoreCase(getResources().getString(R.string.select_date)) ) {
                    SnackbarDelete = Snackbar
                            .make(coordinatorLayoutDelete, getResources().getString(R.string.check_selection), Snackbar.LENGTH_SHORT);


                    if (hour.equalsIgnoreCase(getResources().getString(R.string.select_hour))) {
                        hour_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }

                    if (projector.equalsIgnoreCase(getResources().getString(R.string.select_projector))) {
                        projector_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }

                    if (date.equalsIgnoreCase(getResources().getString(R.string.select_date))) {
                        date_spinner.setError(getResources().getString(R.string.select_proper_value));
                    }
                }

                else {
                    deleteData(hour, date, projector, code);
                }
            }
        });

    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        date_array.clear();
        hour_array.clear();
        projector_array.clear();
        this.finish();
    }

    private void deleteData(final String hour, final String date, final String projector, final String code) {
        // Tag used to cancel the request
        String tag_string_req = "del_proj";
        pDialog.setMessage("Deleting Request");
        showDialog();

        final StringRequest strReq = new StringRequest(com.android.volley.Request.Method.POST,
                BuildConfig.URL_delete, new com.android.volley.Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    // Check for error node in json
                    if (!error) {
                        SnackbarDelete = Snackbar
                                .make(coordinatorLayoutDelete, getResources().getString(R.string.successfully_deleted), Snackbar.LENGTH_SHORT);
                        SnackbarDelete.show();
                        MainActivity.dept_projector.clear();
                        projector_array.clear();
                        date_array.clear();
                        hour_array.clear();
                        Intent i = new Intent(DeleteRequest.this, MainActivity.class);
                        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                        startActivity(i);
                        finish();

                    } else {
                        String errorMsg = jObj.getString("error_msg");
                        SnackbarDelete = Snackbar
                                .make(coordinatorLayoutDelete, errorMsg, Snackbar.LENGTH_SHORT);
                        SnackbarDelete.show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    SnackbarDelete = Snackbar
                            .make(coordinatorLayoutDelete, getString(R.string.unknown), Snackbar.LENGTH_SHORT);
                    SnackbarDelete.show();
                }

            }
        }, new com.android.volley.Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {

                SnackbarDelete = Snackbar
                        .make(coordinatorLayoutDelete, error.getMessage(), Snackbar.LENGTH_SHORT);
                SnackbarDelete.show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<>();
                params.put("date", date);
                params.put("hour", hour);
                params.put("projector", projector);
                params.put("code", code);
                params.put("dept", dept);

                return params;
            }
        };
        AppController.getInstance().addToRequestQueue(strReq, tag_string_req);
    }

    private void cancelData(final String code) {
        // Tag used to cancel the request
        String tag_string_req = "cancel_proj";
        pDialog.setMessage("Looking for booked Projectors");
        showDialog();

        final StringRequest strReq = new StringRequest(com.android.volley.Request.Method.POST,
                BuildConfig.URL_cancel, new com.android.volley.Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    // Check for error node in json
                    if (!error) {
                        JSONArray dateJSONArray = jObj.getJSONArray("date");
                        JSONArray hourJSONArray = jObj.getJSONArray("hour");
                        JSONArray projectorJSONArray = jObj.getJSONArray("projector");

                        for (int i = 0; i < dateJSONArray.length(); i++) {
                            date_array.add(dateJSONArray.getString(i));
                            hour_array.add(hourJSONArray.getString(i));
                            projector_array.add(projectorJSONArray.getString(i));
                        }

                        if (dateJSONArray.length()==0) {
                            Toast.makeText(DeleteRequest.this, getResources().getString(R.string.no_booked), Toast.LENGTH_SHORT).show();
                            projector_array.clear();
                            hour_array.clear();
                            date_array.clear();
                            MainActivity.dept_projector.clear();
                            Intent i = new Intent(DeleteRequest.this, MainActivity.class);
                            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                            startActivity(i);
                        }

                        } else {
                        String errorMsg = jObj.getString("error_msg");
                        SnackbarDelete = Snackbar
                                .make(coordinatorLayoutDelete, errorMsg, Snackbar.LENGTH_SHORT);
                        SnackbarDelete.show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    SnackbarDelete = Snackbar
                            .make(coordinatorLayoutDelete, getString(R.string.unknown), Snackbar.LENGTH_SHORT);
                    SnackbarDelete.show();
                }

            }
        }, new com.android.volley.Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {

                SnackbarDelete = Snackbar
                        .make(coordinatorLayoutDelete, error.getMessage(), Snackbar.LENGTH_SHORT);
                SnackbarDelete.show();
                hideDialog();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<>();
                params.put("code", code);
                params.put("dept", dept);

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
