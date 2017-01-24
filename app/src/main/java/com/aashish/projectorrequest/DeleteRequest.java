package com.aashish.projectorrequest;

import android.app.ProgressDialog;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;

import com.codetroopers.betterpickers.calendardatepicker.CalendarDatePickerDialogFragment;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

import fr.ganfra.materialspinner.MaterialSpinner;

public class DeleteRequest extends AppCompatActivity {

    Calendar c;
    int year, month, day;
    SimpleDateFormat formatter;
    String code;
    EditText date1;
    MaterialSpinner period;
    String[] period_delete = {"1", "2", "3", "4", "5", "6", "7", "8"};
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
        c = Calendar.getInstance();
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

    }
    public void getCurrentDate(View view) {
        Calendar calendar = Calendar.getInstance();
        SimpleDateFormat mdformat = new SimpleDateFormat("yyyy / MM / dd ");
        String strDate = mdformat.format(calendar.getTime());
    }
}
