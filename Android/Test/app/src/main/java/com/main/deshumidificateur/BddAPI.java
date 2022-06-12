package com.main.deshumidificateur;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Query;

public interface BddAPI {
    //Get
    @GET("api.php/?get=*&where=connexion")
    Call<List<connectionResult>> getUser();
    @GET("api.php/?get=*&where=log")
    Call<List<logResult>> getLocalisation();
    //"Put"
    @GET("api.php/?updatebpjava=*&where=status&what=statusAll")
    Call<List<connectionResult>> putPower(@Query("auth") String sha1, @Query("value") String onOff);
    @GET("api.php/?updatebpjava=*&where=status&what=vitVentil&value=off")
    Call<List<connectionResult>> putSpeedFan(@Query("auth") String sha1, @Query("value") Integer speedFan);

}
