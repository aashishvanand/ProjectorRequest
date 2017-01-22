package com.aashish.projectorrequest;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import static junit.runner.BaseTestRunner.savePreferences;

public class Login extends AppCompatActivity implements View.OnClickListener {

    EditText code,password;
    Button submit;
    public static final String PREFS_PRIVATE = "PREFS_PRIVATE";
    public static final String KEY_PRIVATE = "KEY_PRIVATE";
    private SharedPreferences prefsPrivate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        password = (EditText)findViewById(R.id.password);
        submit=(Button)findViewById(R.id.submit);
        submit.setOnClickListener(this);

    }


    @Override
    public void onClick(View view) {
        code=(EditText)findViewById(R.id.code);
        prefsPrivate = getSharedPreferences(Login.PREFS_PRIVATE, Context.MODE_PRIVATE);
        SharedPreferences.Editor privateEdit = prefsPrivate.edit();
        privateEdit.putString(Login.KEY_PRIVATE, code.getText().toString());
        privateEdit.commit();
        Intent intent = new Intent(Login.this, Request.class);
        startActivity(intent);
    }
}
