package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.codetroopers.betterpickers.calendardatepicker.CalendarDatePickerDialogFragment;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import fr.ganfra.materialspinner.MaterialSpinner;

public class DeleteRequest extends AppCompatActivity {

    public static final String PREF = "Projectrequest";
    SimpleDateFormat formatter;
    String code;
    EditText date1;
    MaterialSpinner period;
    String[] period_delete = {"1", "2", "3", "4", "5", "6", "7", "8"};
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


        final ArrayAdapter<String> period_adapter = new ArrayAdapter<String>(getApplication(), android.R.layout.simple_spinner_item, period_delete);
        period_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        period = (MaterialSpinner) findViewById(R.id.period);
        period.setAdapter(period_adapter);
        period.setHint("Select Period");

        date1 = (EditText) findViewById(R.id.date);

        submit = (Button) findViewById(R.id.submit);

        date1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Get Current Date
                CalendarDatePickerDialogFragment cdp = new CalendarDatePickerDialogFragment();
                cdp.show(DeleteRequest.this.getSupportFragmentManager(), "Material Calendar Example");
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

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String hour = period.getSelectedItem().toString();
                String date = date1.getText().toString();
                //deleteData(hour,date,code);
                deleteData(hour, date, "cs11");
            }
        });

    }

    private void deleteData(final String hour, final String date, final String code) {
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
                                .make(coordinatorLayoutDelete, "Successfully Deleted", Snackbar.LENGTH_SHORT);
                        SnackbarDelete.show();

                        Intent i = new Intent(DeleteRequest.this, MainActivity.class);
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
                            .make(coordinatorLayoutDelete, getString(R.string.wrong_user_or_password_combination), Snackbar.LENGTH_SHORT);
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
                params.put("code", code);

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
