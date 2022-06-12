package com.main.deshumidificateur;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.SeekBar;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.Toast;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.squareup.picasso.Picasso;

import java.util.List;
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
    @SuppressLint("UseSwitchCompatOrMaterialCode")
    Switch switch_power;
    SeekBar seekBar_fan;
    String on, off;

    @SuppressLint("WrongViewCast")
    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);
        //Intent to get extra (sha1)
        Intent i = getIntent();
        String hc = i.getStringExtra("hc");
        getLocalisation(hc);
        //Switch to On/Off the device
        on = "on";
        off = "off";
        switch_power = findViewById(R.id.switch_power);
        switch_power.setOnClickListener(view -> {
            if(switch_power.isChecked())
            {
                putPower(hc, on);
                System.out.println("!!!!!!!!!!!!!!!! on !!!!!!!!!!!!!!");
            }
            else
            {
                putPower(hc, off);
                System.out.println("!!!!!!!!!!!!!!!! off !!!!!!!!!!!!!!");
            }
        });
        //SeekBar to change the value of the fan
        seekBar_fan = findViewById(R.id.seekBar_fan);
        seekBar_fan.setOnSeekBarChangeListener(new SeekBar.OnSeekBarChangeListener() {
            @Override
            public void onProgressChanged(SeekBar seekBar, int progressValue, boolean fromUser) {
                putSpeedFan(hc, progressValue);
            }

            @Override
            public void onStartTrackingTouch(SeekBar seekBar) {

            }

            @Override
            public void onStopTrackingTouch(SeekBar seekBar) {

            }
        });
        //Button to permut to activity main
        btn_disconnect = findViewById(R.id.btn_disconnect);
        Intent disconnection = new Intent().setClass(getApplicationContext(), MainActivity.class);
        btn_disconnect.setOnClickListener(view -> startActivity(disconnection));
        //Button to permut to activity weather
        imgBtn_weather = findViewById(R.id.imgBtn_weather);
        Intent weatherActivity = new Intent().setClass(getApplicationContext(), WeatherActivity.class);
        imgBtn_weather.setOnClickListener(view -> startActivity(weatherActivity));
    }
    public void putPower(String hc, String onOff) {
        //retrofit user
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://87.91.26.207/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        BddAPI service = retrofit.create(BddAPI.class);
        Call<List<connectionResult>> result = service.putPower(hc, onOff);
        result.enqueue(new Callback<List<connectionResult>>() {
            @Override
            public void onResponse(@NonNull Call<List<connectionResult>> call, @NonNull Response<List<connectionResult>> response) {
                if (response.isSuccessful()) {
                    List<connectionResult> res = response.body();
                    assert res != null;
                }
            }
            @Override
            public void onFailure(@NonNull Call<List<connectionResult>> call, @NonNull Throwable t) {
                System.out.println(t);
                //Toast.makeText(getApplicationContext(), "Server error", Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void putSpeedFan(String hc, Integer speedFan) {
        //retrofit user
        LinearLayout layout_weather;
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://87.91.26.207/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        BddAPI service = retrofit.create(BddAPI.class);
        Call<List<connectionResult>> result = service.putSpeedFan(hc, speedFan);
        result.enqueue(new Callback<List<connectionResult>>() {
            @Override
            public void onResponse(@NonNull Call<List<connectionResult>> call, @NonNull Response<List<connectionResult>> response) {
                if (response.isSuccessful()) {
                    List<connectionResult> res = response.body();
                    assert res != null;
                }
            }
            @Override
            public void onFailure(@NonNull Call<List<connectionResult>> call, @NonNull Throwable t) {
                System.out.println(t);
                //Toast.makeText(getApplicationContext(), "Server error", Toast.LENGTH_SHORT).show();
            }
        });
    }

    public void getLocalisation(String hc) {

        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://87.91.26.207/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        BddAPI service = retrofit.create(BddAPI.class);
        Call<List<logResult>> result = service.getLocalisation();
        result.enqueue(new Callback<List<logResult>>() {
            @SuppressLint("SetTextI18n")
            @Override
            public void onResponse(@NonNull Call<List<logResult>> call, @NonNull Response<List<logResult>> response) {
                if (response.isSuccessful()) {
                    List<logResult> res = response.body();
                    assert res != null;
                    for(logResult logResult : res) {
                        /*if (logResult.getId().equals(hc))
                        {
                            getWeatherByCity(logResult.getLocalisation());
                        }*/
                    }
                }
            }
            @Override
            public void onFailure(@NonNull Call<List<logResult>> call, @NonNull Throwable t) {
                System.out.println(t);
                //Toast.makeText(getApplicationContext(), "Server error", Toast.LENGTH_SHORT).show();
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
