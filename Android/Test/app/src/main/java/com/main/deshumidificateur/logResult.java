package com.main.deshumidificateur;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class logResult {

    @SerializedName("id")
    @Expose
    private String id;
    @SerializedName("temp")
    @Expose
    private Integer temp;
    @SerializedName("niv_eau")
    @Expose
    private String nivEau;
    @SerializedName("humidite")
    @Expose
    private String humidite;
    @SerializedName("moy_humi")
    @Expose
    private String moyHumi;
    @SerializedName("moy_temp")
    @Expose
    private Integer moyTemp;
    @SerializedName("localisation")
    @Expose
    private String localisation;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public Integer getTemp() {
        return temp;
    }

    public void setTemp(Integer temp) {
        this.temp = temp;
    }

    public String getNivEau() {
        return nivEau;
    }

    public void setNivEau(String nivEau) {
        this.nivEau = nivEau;
    }

    public String getHumidite() {
        return humidite;
    }

    public void setHumidite(String humidite) {
        this.humidite = humidite;
    }

    public String getMoyHumi() {
        return moyHumi;
    }

    public void setMoyHumi(String moyHumi) {
        this.moyHumi = moyHumi;
    }

    public Integer getMoyTemp() {
        return moyTemp;
    }

    public void setMoyTemp(Integer moyTemp) {
        this.moyTemp = moyTemp;
    }

    public String getLocalisation() {
        return localisation;
    }

    public void setLocalisation(String localisation) {
        this.localisation = localisation;
    }

}