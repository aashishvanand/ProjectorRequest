package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

/**
 * Created by AASHI on 1/24/2017.
 */

public class DetailedView extends AppCompatActivity {

    CoordinatorLayout coordinatorLayoutMainActivity;
    Snackbar SnackbarMainActivity;
    SessionManager session;
    TextView hour1header, hour2header, hour3header, hour4header, hour5header, hour6header, hour7header, hour8header;
    TextView hour1, hour2, hour3, hour4, hour5, hour6, hour7, hour8;
    ArrayList<String> hourArray = new ArrayList<String>();
    ArrayList<String> staffcodeArray = new ArrayList<String>();
    ArrayList<String> projectorArray = new ArrayList<String>();
    ArrayList<String> sectionArray = new ArrayList<String>();
    ArrayList<String> yearArray = new ArrayList<String>();
    ArrayList<String> departmentArray = new ArrayList<String>();
    private FloatingActionButton fab;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detailedview);

        hour1 = (TextView) findViewById(R.id.hour1);
        hour2 = (TextView) findViewById(R.id.hour2);
        hour3 = (TextView) findViewById(R.id.hour3);
        hour4 = (TextView) findViewById(R.id.hour4);
        hour5 = (TextView) findViewById(R.id.hour5);
        hour6 = (TextView) findViewById(R.id.hour6);
        hour7 = (TextView) findViewById(R.id.hour7);
        hour8 = (TextView) findViewById(R.id.hour8);

        hour1header = (TextView) findViewById(R.id.hour1header);
        hour2header = (TextView) findViewById(R.id.hour2header);
        hour3header = (TextView) findViewById(R.id.hour3header);
        hour4header = (TextView) findViewById(R.id.hour4header);
        hour5header = (TextView) findViewById(R.id.hour5header);
        hour6header = (TextView) findViewById(R.id.hour6header);
        hour7header = (TextView) findViewById(R.id.hour7header);
        hour8header = (TextView) findViewById(R.id.hour8header);

        coordinatorLayoutMainActivity = (CoordinatorLayout) findViewById(R.id.coordinatorLayoutMainActivity);
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        getdata(getIntent().getStringExtra("date"));

        fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(DetailedView.this, Request.class);
                startActivity(intent);
            }
        });


    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.delete) {
            startActivity(new Intent(this, com.aashish.projectorrequest.DeleteRequest.class));
            return true;
        }

        if (id == R.id.logout) {
            //session.setLogin(false);
            startActivity(new Intent(this, com.aashish.projectorrequest.Login.class));
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    private void getdata(final String date) {
        String tag_string_req = "load_timetable";
        pDialog.setMessage("Loading TimeTable");

        showDialog();

        StringRequest strReq = new StringRequest(com.android.volley.Request.Method.POST,
                BuildConfig.URL_get, new com.android.volley.Response.Listener<String>() {

            @Override
            public void onResponse(String response) {

                hideDialog();

                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    // Check for error node in json
                    if (!error) {
                        JSONArray hourJSONArray = jObj.getJSONArray("hour");
                        JSONArray staffcodeJSONArray = jObj.getJSONArray("staffcode");
                        JSONArray projectorJSONArray = jObj.getJSONArray("projector");
                        JSONArray yearJSONArray = jObj.getJSONArray("year");
                        JSONArray departmentJSONArray = jObj.getJSONArray("department");
                        JSONArray sectionJSONArray = jObj.getJSONArray("section");

                        for (int i = 0; i < hourJSONArray.length(); i++) {
                            hourArray.add(hourJSONArray.getString(i));
                            staffcodeArray.add(staffcodeJSONArray.getString(i));
                            projectorArray.add(projectorJSONArray.getString(i));
                            yearArray.add(yearJSONArray.getString(i));
                            departmentArray.add(departmentJSONArray.getString(i));
                            sectionArray.add(sectionJSONArray.getString(i));

                        }

                        String hour;
                        String text1 = "", text2 = "", text3 = "", text4 = "", text5 = "", text6 = "", text7 = "", text8 = "";
                        for (int i = 0; i < hourArray.size(); i++) {
                            hour = hourArray.get(i);
                            switch (hour) {
                                case "1":
                                    text1 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +  "\n";

                                    break;
                                case "2":
                                    text2 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                                case "3":
                                    text3 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                                case "4":
                                    text4 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                                case "5":
                                    text5 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                                case "6":
                                    text6 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                                case "7":
                                    text7 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                                case "8":
                                    text8 += projectorArray.get(i) + " Booked by " + staffcodeArray.get(i) + " for " + yearArray.get(i) + " " + departmentArray.get(i) + " " + sectionArray.get(i) +   "\n";
                                    break;
                            }
                        }

                        if (!text1.equals("")) {
                            hour1header.setVisibility(View.VISIBLE);
                            hour1.setText(text1);
                            hour1.setVisibility(View.VISIBLE);
                        }

                        if (!text2.equals("")) {
                            hour2header.setVisibility(View.VISIBLE);
                            hour2.setText(text2);
                            hour2.setVisibility(View.VISIBLE);
                        }

                        if (!text3.equals("")) {
                            hour3header.setVisibility(View.VISIBLE);
                            hour3.setText(text3);
                            hour3.setVisibility(View.VISIBLE);
                        }
                        if (!text4.equals("")) {
                            hour4header.setVisibility(View.VISIBLE);
                            hour4.setText(text4);
                            hour4.setVisibility(View.VISIBLE);
                        }

                        if (!text5.equals("")) {
                            hour5header.setVisibility(View.VISIBLE);
                            hour5.setText(text5);
                            hour5.setVisibility(View.VISIBLE);
                        }
                        if (!text6.equals("")) {
                            hour6header.setVisibility(View.VISIBLE);
                            hour6.setText(text6);
                            hour6.setVisibility(View.VISIBLE);
                        }

                        if (!text7.equals("")) {
                            hour7header.setVisibility(View.VISIBLE);
                            hour7.setText(text1);
                            hour7.setVisibility(View.VISIBLE);
                        }

                        if (!text8.equals("")) {
                            hour8header.setVisibility(View.VISIBLE);
                            hour8.setText(text1);
                            hour8.setVisibility(View.VISIBLE);
                        }

                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                        SnackbarMainActivity = Snackbar
                                .make(coordinatorLayoutMainActivity, errorMsg, Snackbar.LENGTH_SHORT);
                        SnackbarMainActivity.show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    SnackbarMainActivity = Snackbar
                            .make(coordinatorLayoutMainActivity, e.toString(), Snackbar.LENGTH_SHORT);
                    SnackbarMainActivity.show();
                }
            }
        }, new com.android.volley.Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {

                SnackbarMainActivity = Snackbar
                        .make(coordinatorLayoutMainActivity, error.getMessage(), Snackbar.LENGTH_SHORT);
                SnackbarMainActivity.show();
            }
        }) {

            @Override
            protected Map<String, String> getParams() {
                // Posting parameters to login url
                Map<String, String> params = new HashMap<>();
                params.put("date", date);
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
