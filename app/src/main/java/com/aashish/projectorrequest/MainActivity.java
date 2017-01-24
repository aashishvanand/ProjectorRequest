package com.aashish.projectorrequest;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;


public class MainActivity extends AppCompatActivity {

    ImageView day1_imageView,day2_imageView,day3_imageView,day4_imageView,day5_imageView,day6_imageView;
    TextView day1_day,day2_day,day3_day,day4_day,day5_day,day6_day;
    TextView day1_month,day2_month,day3_month,day4_month,day5_month,day6_month;
    TextView day1_year,day2_year,day3_year,day4_year,day5_year,day6_year;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        day1_imageView = (ImageView) findViewById(R.id.day1_imageView);
        day2_imageView = (ImageView) findViewById(R.id.day2_imageView);
        day3_imageView = (ImageView) findViewById(R.id.day3_imageView);
        day4_imageView = (ImageView) findViewById(R.id.day4_imageView);
        day5_imageView = (ImageView) findViewById(R.id.day5_imageView);
        day6_imageView = (ImageView) findViewById(R.id.day6_imageView);

        day1_day =(TextView) findViewById(R.id.day1_day);
        day2_day =(TextView) findViewById(R.id.day2_day);
        day3_day =(TextView) findViewById(R.id.day3_day);
        day4_day =(TextView) findViewById(R.id.day4_day);
        day5_day =(TextView) findViewById(R.id.day5_day);
        day6_day =(TextView) findViewById(R.id.day6_day);

        day1_month = (TextView) findViewById(R.id.day1_month);
        day2_month = (TextView) findViewById(R.id.day2_month);
        day3_month = (TextView) findViewById(R.id.day3_month);
        day4_month = (TextView) findViewById(R.id.day4_month);
        day5_month = (TextView) findViewById(R.id.day5_month);
        day6_month = (TextView) findViewById(R.id.day6_month);

        day1_year = (TextView) findViewById(R.id.day1_year);
        day2_year = (TextView) findViewById(R.id.day2_year);
        day3_year = (TextView) findViewById(R.id.day3_year);
        day4_year = (TextView) findViewById(R.id.day4_year);
        day5_year = (TextView) findViewById(R.id.day5_year);
        day6_year = (TextView) findViewById(R.id.day6_year);

        Calendar calendar = Calendar.getInstance();
        Date day1_date = calendar.getTime();

        calendar.add(Calendar.DAY_OF_YEAR, 1);
        Date day2_date = calendar.getTime();

        calendar.add(Calendar.DAY_OF_YEAR, 2);
        Date day3_date = calendar.getTime();

        calendar.add(Calendar.DAY_OF_YEAR, 3);
        Date day4_date = calendar.getTime();

        calendar.add(Calendar.DAY_OF_YEAR, 4);
        Date day5_date = calendar.getTime();

        calendar.add(Calendar.DAY_OF_YEAR, 5);
        Date day6_date = calendar.getTime();


        DateFormat intent = new SimpleDateFormat("yyyy-MM-dd");
        DateFormat year = new SimpleDateFormat("yyyy");
        DateFormat month = new SimpleDateFormat("MMM");
        DateFormat date = new SimpleDateFormat("dd");

        final String day1 = intent.format(day1_date);
        final String day2 = intent.format(day2_date);
        final String day3 = intent.format(day3_date);
        final String day4 = intent.format(day4_date);
        final String day5 = intent.format(day5_date);
        final String day6 = intent.format(day6_date);

        day1_day.setText(date.format(day1_date));
        day1_month.setText(month.format(day1_date));
        day1_year.setText(year.format(day1_date));

        day2_day.setText(date.format(day2_date));
        day2_month.setText(month.format(day2_date));
        day2_year.setText(year.format(day2_date));

        day3_day.setText(date.format(day3_date));
        day3_month.setText(month.format(day3_date));
        day3_year.setText(year.format(day3_date));

        day4_day.setText(date.format(day4_date));
        day4_month.setText(month.format(day4_date));
        day4_year.setText(year.format(day4_date));

        day5_day.setText(date.format(day5_date));
        day5_month.setText(month.format(day5_date));
        day5_year.setText(year.format(day5_date));

        day6_day.setText(date.format(day6_date));
        day6_month.setText(month.format(day6_date));
        day6_year.setText(year.format(day6_date));

        day1_imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), DetailedView.class);
                intent.putExtra("date", day1);
                startActivity(intent);
            }
        });

        day2_imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), DetailedView.class);
                intent.putExtra("date", day2);
                startActivity(intent);
            }
        });

        day3_imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), DetailedView.class);
                intent.putExtra("date", day3);
                startActivity(intent);

            }
        });

        day4_imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), DetailedView.class);
                intent.putExtra("date", day4);
                startActivity(intent);
            }
        });

        day5_imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), DetailedView.class);
                intent.putExtra("date", day5);
                startActivity(intent);
            }
        });

        day6_imageView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(getBaseContext(), DetailedView.class);
                intent.putExtra("date", day6);
                startActivity(intent);
            }
        });


    }

}
