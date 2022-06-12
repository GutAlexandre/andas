package com.main.deshumidificateur;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class connectionResult {

    @SerializedName("id")
    @Expose
    private String id;
    @SerializedName("ssid")
    @Expose
    private String ssid;
    @SerializedName("mdp_wifi")
    @Expose
    private String mdpWifi;
    @SerializedName("login")
    @Expose
    private String login;
    @SerializedName("mdp_user")
    @Expose
    private String mdpUser;

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public connectionResult withId(String id) {
        this.id = id;
        return this;
    }

    public String getSsid() {
        return ssid;
    }

    public void setSsid(String ssid) {
        this.ssid = ssid;
    }

    public connectionResult withSsid(String ssid) {
        this.ssid = ssid;
        return this;
    }

    public String getMdpWifi() {
        return mdpWifi;
    }

    public void setMdpWifi(String mdpWifi) {
        this.mdpWifi = mdpWifi;
    }

    public connectionResult withMdpWifi(String mdpWifi) {
        this.mdpWifi = mdpWifi;
        return this;
    }

    public String getLogin() {
        return login;
    }

    public void setLogin(String login) {
        this.login = login;
    }

    public connectionResult withLogin(String login) {
        this.login = login;
        return this;
    }

    public String getMdpUser() {
        return mdpUser;
    }

    public void setMdpUser(String mdpUser) {
        this.mdpUser = mdpUser;
    }

    public connectionResult withMdpUser(String mdpUser) {
        this.mdpUser = mdpUser;
        return this;
    }

}