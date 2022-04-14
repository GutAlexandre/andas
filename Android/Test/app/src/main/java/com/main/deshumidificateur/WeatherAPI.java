package com.main.deshumidificateur;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface WeatherAPI {
    String appid = "5a1f55a765db6ccd1813e47afad94918";
    @GET("weather?&appid="+appid+"&units=metric")
    Call<WeatherResult> getWeatherByCity(@Query("q") String cityName);
}
