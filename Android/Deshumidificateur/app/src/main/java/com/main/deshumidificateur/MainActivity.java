package com.main.deshumidificateur;

import android.os.Bundle;
import android.widget.ImageView;
import android.widget.SeekBar;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;


public class MainActivity extends AppCompatActivity
{
    //Variables definition
    ImageView btn_power;
    Integer btn_state;
    SeekBar seekBar_fan;
    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //Button on/off management
        btn_power = findViewById(R.id.btn_power);
        btn_power.setTag(R.mipmap.btn_power_off);
        btn_power.setOnClickListener(v ->
        {
            //Get button on/off state
            btn_state = (Integer) btn_power.getTag();
            //button on/off state comparison: si off -> on, si on -> off
            if(btn_state == R.mipmap.btn_power_off)
            {
                btn_power.setImageResource(R.mipmap.btn_power_on);
                btn_power.setTag(R.mipmap.btn_power_on);
            }
            else
            {
                btn_power.setImageResource(R.mipmap.btn_power_off);
                btn_power.setTag(R.mipmap.btn_power_off);
            }
        });
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