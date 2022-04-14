package com.main.deshumidificateur;

public class WeatherResult {
    String name;
    MainJson main;
    WeatherJson[] weather;
    public WeatherResult() {

    }
}

class MainJson {
    double temp;
    int humidity;
    public MainJson() {
    }
}

class WeatherJson {
    String icon;
    public WeatherJson() {
    }

}
