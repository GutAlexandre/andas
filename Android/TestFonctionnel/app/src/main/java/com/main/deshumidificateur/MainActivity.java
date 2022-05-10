package com.main.deshumidificateur;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.google.common.hash.HashCode;
import com.google.common.hash.HashFunction;
import com.google.common.hash.Hashing;
import com.google.common.primitives.Chars;

import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class MainActivity extends AppCompatActivity {

    Button btn_submit;
    EditText editTxt_login;
    EditText editTxt_passwd;
    String login;
    String password;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        editTxt_login = findViewById(R.id.editTxt_login);
        editTxt_passwd = findViewById(R.id.editTxt_passwd);

        btn_submit = findViewById(R.id.btn_submit);
        btn_submit.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                login = editTxt_login.getText().toString();
                password = editTxt_passwd.getText().toString();
                getUser(login, password);
            }
        });
    }

    public void getUser(String login, String password) {
        //retrofit user
        Retrofit retrofit = new Retrofit.Builder()
                .baseUrl("http://87.91.26.207/")
                .addConverterFactory(GsonConverterFactory.create())
                .build();
        BddAPI service = retrofit.create(BddAPI.class);
        Call<List<BddResult>> result = service.getUser();
        result.enqueue(new Callback<List<BddResult>>() {
            @Override
            public void onResponse(Call<List<BddResult>> call, Response<List<BddResult>> response) {
                if (response.isSuccessful()) {
                    List<BddResult> res = response.body();
                    assert res != null;
                    final HashFunction hf = Hashing.sha1();
                    HashCode hc = hf.newHasher()
                            .putString(login+password, StandardCharsets.UTF_8)
                            .hash();
                    for(BddResult bddResult : res) {
                        if(bddResult.getId().equals(hc.toString()))
                        {
                            Intent i = new Intent().setClass(getApplicationContext(), AppActivity.class);
                            Toast.makeText(getApplicationContext(), "Connexion", Toast.LENGTH_SHORT).show();
                            startActivity(i);
                        }
                        else
                        {
                            Toast.makeText(getApplicationContext(),
                                    "Login ou mot de passe incorrect",
                                    Toast.LENGTH_SHORT).show();
                        }
                    }
                }
            }
            @Override
            public void onFailure(Call<List<BddResult>> call, Throwable t) {
                System.out.println(t);
                Toast.makeText(getApplicationContext(), "Server error", Toast.LENGTH_SHORT).show();
            }
        });
    }
}
