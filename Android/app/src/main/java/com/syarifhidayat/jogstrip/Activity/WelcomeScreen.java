package com.syarifhidayat.jogstrip.Activity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;
import com.syarifhidayat.jogstrip.R;

public class WelcomeScreen extends AppCompatActivity {
    private static int SPLASH_TIME_OUT = 4000;
    private ImageView ivLogo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcomescreen);

        //GOTO home & open next actv
        ivLogo = (ImageView) findViewById(R.id.welcomeLogo);

        Animation myAnim = AnimationUtils.loadAnimation(this, R.anim.transition);
        ivLogo.startAnimation(myAnim);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent homeIntent = new Intent(WelcomeScreen.this, Home.class);
                startActivity(homeIntent);
                finish();
            }
        }, SPLASH_TIME_OUT);
    }
}
