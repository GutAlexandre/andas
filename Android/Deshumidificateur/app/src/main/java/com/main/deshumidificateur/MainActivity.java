package com.main.deshumidificateur;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.widget.SeekBar;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;


@SuppressLint("UseSwitchCompatOrMaterialCode")
public class MainActivity extends AppCompatActivity
{
    //Variables definition
    SeekBar seekBar_fan;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //Fan seek bar management
        seekBar_fan = findViewById(R.id.seekBar_fan);
        seekBar_fan.setOnSeekBarChangeListener(new SeekBar.OnSeekBarChangeListener()
        {
            int progressChangedValue = 0;

            public void onProgressChanged(SeekBar seekBar, int progress, boolean fromUser) {
                progressChangedValue = progress;
            }

            public void onStartTrackingTouch(SeekBar seekBar) {
                // TODO Auto-generated method stub
            }

            public void onStopTrackingTouch(SeekBar seekBar) {
                Toast.makeText(MainActivity.this,
                        "Seek bar progress is :" + progressChangedValue,
                        Toast.LENGTH_SHORT).show();
            }
        });
    }
}