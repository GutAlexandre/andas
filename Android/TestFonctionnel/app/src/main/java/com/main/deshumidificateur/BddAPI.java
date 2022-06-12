package com.main.deshumidificateur;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.GET;

public interface BddAPI {
    @GET("api.php/?get=*&where=connexion")
    Call<List<BddResult>> getUser();
}
