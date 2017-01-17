package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class Request extends AppCompatActivity {

    private ProgressDialog pDialog;
    EditText date,hour,staffcode,projector;
    Button submit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_request);

        date = (EditText) findViewById(R.id.date);
        hour = (EditText) findViewById(R.id.hour);
        staffcode = (EditText) findViewById(R.id.staffcode);
        projector =(EditText) findViewById(R.id.projector);
        submit = (Button) findViewById(R.id.submit);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                requestdata();
            }
        });
    }

    private void requestdata()
    {
        // Tag used to cancel the request
        pDialog = new ProgressDialog(this);
        pDialog.setTitle("Request_Data");
        pDialog.setCancelable(false);
        String tag_string_req = "request_data";

        pDialog.setMessage("Making a Request");
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
                Map<String, String> params = new HashMap<>();
                params.put("date", date.getText().toString());
                params.put("hour", hour.getText().toString());
                params.put("staffcode", staffcode.getText().toString());
                params.put("projector", projector.getText().toString());

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
