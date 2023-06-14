package com.syarifhidayat.jogstrip.Activity;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.CardView;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.Toast;
import android.widget.ViewFlipper;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.*;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.tasks.OnSuccessListener;
import com.syarifhidayat.jogstrip.Adapter.AdapterSlidingHome;
import com.syarifhidayat.jogstrip.R;
import com.viewpagerindicator.CirclePageIndicator;

import java.util.ArrayList;
import java.util.Timer;
import java.util.TimerTask;

import static android.Manifest.permission.ACCESS_FINE_LOCATION;

public class Home extends AppCompatActivity implements View.OnClickListener, OnMapReadyCallback
        , GoogleMap.OnMyLocationButtonClickListener
        , GoogleMap.OnMyLocationClickListener {
    private CardView gotoHotel, gotoResto, gotoWisata, gotoPanduan;
    ViewFlipper vf_home;

    private GoogleMap mMap;

    public static double selfLat, selfLng;
    private FusedLocationProviderClient fusedLocationProviderClient;
    public static Location mLastLocation;


    private static ViewPager mPager;
    private static int currentPage = 0;
    private static int NUM_PAGES = 0;
    private static final Integer[] IMAGES= {R.drawable.home_1,R.drawable.home_2,R.drawable.home_3};
    private ArrayList<Integer> ImagesArray = new ArrayList<Integer>();
    private void init() {
        for(int i=0;i<IMAGES.length;i++)
            ImagesArray.add(IMAGES[i]);

        mPager = (ViewPager) findViewById(R.id.pagerHome);


        mPager.setAdapter(new AdapterSlidingHome(Home.this,ImagesArray));


        CirclePageIndicator indicator = (CirclePageIndicator)
                findViewById(R.id.indicatorHome);

        indicator.setViewPager(mPager);

        final float density = getResources().getDisplayMetrics().density;

//Set circle indicator radius
        indicator.setRadius(5 * density);

        NUM_PAGES =IMAGES.length;

        // Auto start of viewpager
        final Handler handler = new Handler();
        final Runnable Update = new Runnable() {
            public void run() {
                if (currentPage == NUM_PAGES) {
                    currentPage = 0;
                }
                mPager.setCurrentItem(currentPage++, true);
            }
        };
        Timer swipeTimer = new Timer();
        swipeTimer.schedule(new TimerTask() {
            @Override
            public void run() {
                handler.post(Update);
            }
        }, 3000, 3000);

        // Pager listener over indicator
        indicator.setOnPageChangeListener(new ViewPager.OnPageChangeListener() {

            @Override
            public void onPageSelected(int position) {
                currentPage = position;

            }

            @Override
            public void onPageScrolled(int pos, float arg1, int arg2) {

            }

            @Override
            public void onPageScrollStateChanged(int pos) {

            }
        });

    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_home);

        //requestPermission();
        fusedLocationProviderClient = LocationServices.getFusedLocationProviderClient(this);

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map_home);
        //mapFragment.getMapAsync(this);
        mapFragment.getMapAsync(this);


        //vf_home = findViewById(R.id.vf_home);

        //defining cardview to btn
        gotoHotel = (CardView) findViewById(R.id.cv_btnMenuHotel);
        gotoResto = (CardView) findViewById(R.id.cv_btnMenuResto);
        gotoWisata = (CardView) findViewById(R.id.cv_btnMenuWisata);
        gotoPanduan = (CardView) findViewById(R.id.cv_btnMenuPanduan);

        //add click listener to cards
        gotoHotel.setOnClickListener(this);
        gotoResto.setOnClickListener(this);
        gotoWisata.setOnClickListener(this);
        gotoPanduan.setOnClickListener(this);

        getLastLocation();
        init();
        //slideImageHome
        /*int images[] = {R.drawable.home_1, R.drawable.home_2, R.drawable.home_3};

        for (int image : images) {
            flipperImages(image);
        }*/
    }

    public void flipperImages(int images) {

        ImageView imageView = new ImageView(this);
        imageView.setBackgroundResource(images);

        vf_home.addView(imageView);
        vf_home.setFlipInterval(4000); //4detik
        vf_home.setAutoStart(true);

        //animation
        vf_home.setInAnimation(this, android.R.anim.slide_in_left);
        vf_home.setOutAnimation(this, android.R.anim.slide_out_right);

    }

    @Override
    public void onClick(View v) {
        Intent i;

        switch (v.getId()) {
            case R.id.cv_btnMenuHotel:
                i = new Intent(this, TabHotel.class);
                startActivity(i);
                break;
            case R.id.cv_btnMenuResto:
                i = new Intent(this, TabTpKuliner.class);
                startActivity(i);
                break;
            case R.id.cv_btnMenuWisata:
                i = new Intent(this, TabTpWisata.class);
                startActivity(i);
                break;
            case R.id.cv_btnMenuPanduan:
                i = new Intent(this, Panduan.class);
                startActivity(i);
                break;
        }
    }

    //Fungsi memanggil lokasi
    private void getLastLocation() {
        if (ActivityCompat.checkSelfPermission(Home.this, ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {

            return;
        }
        fusedLocationProviderClient.getLastLocation().addOnSuccessListener(Home.this, new OnSuccessListener<Location>() {
            @Override
            public void onSuccess(Location location) {

                if (location != null){
                    //myLocation = location.toString();
                    selfLat = location.getLatitude();
                    selfLng = location.getLongitude();
                }

                Log.d("lokasi", "Latitude: " + selfLat);
                Log.d("lokasi", "Longitude: " + selfLng);

                setMapMarker();
            }
        });
    }

    //Marker lokasi saat ini
    private void setMapMarker() {
        LatLng latLng = new LatLng(selfLat, selfLng);
        MarkerOptions markerOptions = new MarkerOptions();
        markerOptions.position(latLng);
        markerOptions.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED));
        markerOptions.title("Posisi Anda Saat Ini");
        markerOptions.snippet(selfLat + ", " + selfLng);
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng));
        mMap.addMarker(markerOptions);
    }

    /*private void requestPermission(){
        ActivityCompat.requestPermissions(Home.this, new String[]{ACCESS_FINE_LOCATION}, 1);
    }*/


    //Memanggil map dari api key
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        mMap.getUiSettings().setAllGesturesEnabled(true);
        mMap.getUiSettings().setZoomControlsEnabled(true);
        mMap.setMinZoomPreference(10);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (ActivityCompat.checkSelfPermission(Home.this, ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
                    && ActivityCompat.checkSelfPermission(Home.this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                ActivityCompat.requestPermissions(Home.this, new String[]{ACCESS_FINE_LOCATION
                        , Manifest.permission.ACCESS_COARSE_LOCATION}, 1);
            } else {
                mMap.setMyLocationEnabled(true);
                mMap.setMyLocationEnabled(true);
            }
        } else {
            mMap.setMyLocationEnabled(true);
        }

        mMap.setOnMyLocationButtonClickListener(this);
        mMap.setOnMyLocationClickListener(this);
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (requestCode == 1) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(Home.this, "Permission Granted", Toast.LENGTH_SHORT).show();
                if (ActivityCompat.checkSelfPermission(Home.this, ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
                        && ActivityCompat.checkSelfPermission(Home.this, Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
                    mMap.setMyLocationEnabled(true);
                }
            } else {
                Toast.makeText(Home.this, "Permission Denied", Toast.LENGTH_SHORT).show();
            }
        }
    }

    CameraUpdate cameraUpdate = null;

    @Override
    public boolean onMyLocationButtonClick() {
        Location loc = mMap.getMyLocation();
        if (loc != null) {
            LatLng latLng = new LatLng(loc.getLatitude(), loc.getLongitude());
            cameraUpdate = CameraUpdateFactory.newLatLngZoom(latLng, 17);
            mMap.animateCamera(cameraUpdate);

        }
        return true;
    }

    @Override
    public void onMyLocationClick(@NonNull Location location) {
        Toast.makeText(Home.this, "Lokasiku saat ini : " + location, Toast.LENGTH_LONG).show();
    }

}
