package com.main.deshumidificateur;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    Button btn_submit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        btn_submit = findViewById(R.id.btn_submit);
        Intent i = new Intent().setClass(getApplicationContext(), AppActivity.class);
        btn_submit.setOnClickListener(view -> startActivity(i));
    }
}
