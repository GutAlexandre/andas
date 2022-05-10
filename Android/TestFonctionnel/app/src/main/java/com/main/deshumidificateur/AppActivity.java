package com.main.deshumidificateur;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.SeekBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.squareup.picasso.Picasso;

import org.w3c.dom.Text;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class AppActivity extends AppCompatActivity
{
    //Variables definition
    Button btn_disconnect;
    ImageButton imgBtn_weather;

    @SuppressLint("WrongViewCast")
    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

        //Button to permut to activity main
        btn_disconnect = findViewById(R.id.btn_disconnect);
        Intent disconnection = new Intent().setClass(getApplicationContext(), MainActivity.class);
        btn_disconnect.setOnClickListener(view -> startActivity(disconnection));
        //Button to permut to activity weather
        imgBtn_weather = findViewById(R.id.imgBtn_weather);
        Intent weatherActivity = new Intent().setClass(getApplicationContext(), WeatherActivity.class);
        imgBtn_weather.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(weatherActivity);
            }
        });
    }
}