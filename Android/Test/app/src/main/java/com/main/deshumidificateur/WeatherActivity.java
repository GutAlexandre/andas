package com.main.deshumidificateur;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class WeatherActivity extends AppCompatActivity {
    Button btn_back;
    EditText plnTxt_city;
    Button btn_searchCity;
    String cityName;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_weather);
        btn_back = findViewById(R.id.btn_back);
        Intent i = new Intent().setClass(getApplicationContext(), AppActivity.class);
        btn_back.setOnClickListener(view -> startActivity(i));

        //Retrofit, access weather site
        plnTxt_city = findViewById(R.id.plnTxt_city);
        btn_searchCity = findViewById(R.id.btn_searchCity);

        btn_searchCity.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                cityName = plnTxt_city.getText().toString();
                getWeatherByCity(cityName);
            }
        });
    }

    public void getWeatherByCity(String cityName){
        TextView txtVw_temperature;
        TextView txtVw_city;
        LinearLayout layout_weather;
        ImageView ic_sun;
        TextView txtVw_humidity;

        txtVw_temperature = findViewById(R.id.txtVw_temperature);
        txtVw_city = findViewById(R.id.txtVw_city);
        ic_sun = findViewById(R.id.ic_sun);
        layout_weather = findViewById(R.id.layout_weather);
        txtVw_humidity = findViewById(R.id.txtVw_humidity);

        //retrofit weather
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("https://api.openweathermap.org/data/2.5/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        WeatherAPI service = retrofit.create(WeatherAPI.class);
        Call<WeatherResult> result = service.getWeatherByCity(cityName);
        result.enqueue(new Callback<WeatherResult>() {
            @SuppressLint("SetTextI18n")
            @Override
            public void onResponse(@NonNull Call<WeatherResult> call, @NonNull Response<WeatherResult> response) {
                if(response.isSuccessful())
                {
                    WeatherResult res = response.body();
                    assert res != null;
                    txtVw_temperature.setText(res.main.temp+" °C");
                    txtVw_city.setText(res.name);
                    txtVw_humidity.setText("Humidity: "+res.main.humidity+"%");
                    Picasso.get().load("https://openweathermap.org/img/w/"+res.weather[0].icon+".png").into(ic_sun);
                    layout_weather.setVisibility(View.VISIBLE);
                }
            }

            @Override
            public void onFailure(@NonNull Call<WeatherResult> call, @NonNull Throwable t) {
                Toast.makeText(getApplicationContext(),"Server error", Toast.LENGTH_SHORT).show();
            }
        });
    }
}