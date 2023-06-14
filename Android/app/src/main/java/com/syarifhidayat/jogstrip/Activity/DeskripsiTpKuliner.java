package com.syarifhidayat.jogstrip.Activity;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.os.Build;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import com.bumptech.glide.Glide;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.*;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.tasks.OnSuccessListener;
import com.syarifhidayat.jogstrip.Adapter.AdapterDetailTempatKuliner;
import com.syarifhidayat.jogstrip.Adapter.AdapterTerdekatTpKuliner;
import com.syarifhidayat.jogstrip.ApiClient;
import com.syarifhidayat.jogstrip.ApiInterface;
import com.syarifhidayat.jogstrip.BasePlace;
import com.syarifhidayat.jogstrip.Getter.DetailTempatKuliners;
import com.syarifhidayat.jogstrip.R;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.List;

import static android.Manifest.permission.ACCESS_FINE_LOCATION;

public class DeskripsiTpKuliner extends AppCompatActivity implements OnMapReadyCallback , GoogleMap.OnMyLocationButtonClickListener
        , GoogleMap.OnMyLocationClickListener {

    RecyclerView rv_terdekatTpKuliner;
    RecyclerView rv_MkKuliner;
    RecyclerView.LayoutManager layoutManager;

    AdapterTerdekatTpKuliner adapterTerdekatTpKuliner;
    AdapterDetailTempatKuliner adapterDetailTempatKuliner;

    List<BasePlace> basePlaceList;
    List<DetailTempatKuliners> listDetailTempatKuliner;

    String idTpKuliner = null, saveNamaTpKuliner, saveAlamatTpKuliner;
    public static float saveLatTpKuliner, saveLngTpKuliner;

    private GoogleMap mMap;
    double selfLat, selfLng;

    double jarakKeTpKuliner;
    TextView tvDesJarakKuliner;
    private FusedLocationProviderClient fusedLocationProviderClient;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_deskripsi_tp_kuliner);

        //menerapkan tool bar sesuai id toolbar | ToolBarAtas adalah variabel buatan sndiri
        Toolbar ToolBarAtas2 = findViewById(R.id.toolbar_desKuliner);
        setSupportActionBar(ToolBarAtas2);
        //ToolBarAtas2.setLogo(R.mipmap.ic_launcher);
        ToolBarAtas2.setLogoDescription(getResources().getString(R.string.app_name));
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ToolBarAtas2.setNavigationOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        startActivity(new Intent(getApplicationContext(),TabTpKuliner.class));
                    }
                }
        );

        ImageView ivDesImgTpKuliner = findViewById(R.id.iv_desImgTpKuliner);
        TextView tvDescNamaTpKuliner = findViewById(R.id.tv_desNamaTpKuliner);
        TextView tvDescDesTpKuliner = findViewById(R.id.tv_desDeskripsiTpKuliner);
        TextView tvDescAlamatTpKuliner = findViewById(R.id.tv_desAlamatTpKuliner);
        tvDesJarakKuliner = findViewById(R.id.tv_desJarakKuliner);

        //rv_terdekat
        rv_terdekatTpKuliner = findViewById(R.id.rv_terdekatTpKuliner);

        basePlaceList = new ArrayList<>();
        adapterTerdekatTpKuliner = new AdapterTerdekatTpKuliner(this, basePlaceList);

        rv_terdekatTpKuliner.setAdapter(adapterTerdekatTpKuliner);
        rv_terdekatTpKuliner.setLayoutManager(new LinearLayoutManager(this));
        rv_terdekatTpKuliner.setNestedScrollingEnabled(false);

        //rv_makanan kuliner
        rv_MkKuliner = findViewById(R.id.rv_MkKuliner);

        layoutManager = new LinearLayoutManager(this);

        rv_MkKuliner.setLayoutManager(layoutManager);

        listDetailTempatKuliner = new ArrayList<>();
        adapterDetailTempatKuliner = new AdapterDetailTempatKuliner(this,listDetailTempatKuliner );

        rv_MkKuliner.setAdapter(adapterDetailTempatKuliner);
        rv_MkKuliner.setLayoutManager(new LinearLayoutManager(this));
        rv_MkKuliner.setNestedScrollingEnabled(false);

        //Get Jarak Lokasi Hotel
        fusedLocationProviderClient = LocationServices.getFusedLocationProviderClient(this);

        idTpKuliner = getIntent().getExtras().getString("idTpKuliner");
        saveNamaTpKuliner = getIntent().getExtras().getString("namaTpKuliner");
        String saveGambarTpKuliner = getIntent().getExtras().getString("gambarTpKuliner");
        String saveDeskripsiTpKuliner = getIntent().getExtras().getString("deskripsiTpKuliner");
        saveAlamatTpKuliner = getIntent().getExtras().getString("alamatTpKuliner");
        saveLatTpKuliner = getIntent().getFloatExtra("latTpKuliner", 0);
        saveLngTpKuliner = getIntent().getFloatExtra("lngTpKuliner", 0);

        tvDescNamaTpKuliner.setText(saveNamaTpKuliner);
        tvDescDesTpKuliner.setText(saveDeskripsiTpKuliner);
        tvDescAlamatTpKuliner.setText(saveAlamatTpKuliner);

        Glide.with(this).load(ApiClient.IMAGEKULINER_URL+ saveGambarTpKuliner)
                .error(R.mipmap.ic_launcher).into(ivDesImgTpKuliner);

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager().findFragmentById(R.id.map_desTpKuliner);
        mapFragment.getMapAsync(this);

        //get terdekat from DB



        getAllTempatTerdekat();
        getDetailTempatKuliner(idTpKuliner);
        hitungJarak();
        getLastLocation();
        // Log.i("aaa", getIntent().getExtras().getString("idTpKuliner"));
    }

    private void getDetailTempatKuliner(String key) {
        ApiInterface apiInterface = ApiClient.getApiClient().create(ApiInterface.class);
        Call<List<DetailTempatKuliners>> call = apiInterface.getDetailTpKuliners(key);

        call.enqueue(new Callback<List<DetailTempatKuliners>>() {
            @Override
            public void onResponse(Call<List<DetailTempatKuliners>> call, Response<List<DetailTempatKuliners>> response) {
                List<DetailTempatKuliners> l = new ArrayList<>();
                l.addAll(response.body());
                listDetailTempatKuliner.clear();
                listDetailTempatKuliner.addAll(response.body());
                adapterDetailTempatKuliner.notifyDataSetChanged();
             /*   for (int i = 0; i < listDetailTempatKuliner.size(); i++) {
                    Log.i("aaa", listDetailTempatKuliner.get(i).getNama());
                }*/
            }

            @Override
            public void onFailure(Call<List<DetailTempatKuliners>> call, Throwable t) {
                Toast.makeText(DeskripsiTpKuliner.this, "Error\n : " + t.toString(), Toast.LENGTH_SHORT).show();
                Log.i("error bos ", t.getMessage());
                t.printStackTrace();
            }
        });
    }

    private void getAllTempatTerdekat() {
        ApiInterface apiInterface = ApiClient.getApiClient().create(ApiInterface.class);
        Call<List<BasePlace>> call = apiInterface.getAllTempatTerdekat("tempat_kuliner", saveLatTpKuliner, saveLngTpKuliner);

        call.enqueue(new Callback<List<BasePlace>>() {
            @Override
            public void onResponse(Call<List<BasePlace>> call, Response<List<BasePlace>> response) {

                List<BasePlace> l = new ArrayList<>();
                l.addAll(response.body());

                basePlaceList.clear();
                for (com.syarifhidayat.jogstrip.BasePlace b : l) {
                    if (b.getJarakTerdekat() <= 3) {
                        if (!b.getNamaTerdekat().equals(saveNamaTpKuliner)) {
                            basePlaceList.add(b);
                        }
                    }
                }

                adapterTerdekatTpKuliner.notifyDataSetChanged();
            }

            @Override
            public void onFailure(Call<List<BasePlace>> call, Throwable t) {
                //progressBar.setVisibility(View.GONE);
                Toast.makeText(DeskripsiTpKuliner.this, "Error\n : " + t.toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }


    //Fungsi perhitungan menghitung jarak
    public static double distFrom(
            double lat1, double lng1, double lat2, double lng2)
    {
        double dbRadiusMeters = 6378137 ; // Earth’s mean radius in meter
        double dbLatitudeDiff = Math.toRadians(lat2 - lat1);
        double dbLongitudeDiff = Math.toRadians(lng2 - lng1);

        double a = Math.sin(dbLatitudeDiff / 2) * Math.sin(dbLatitudeDiff / 2) +
                Math.cos(Math.toRadians(lat1)) * Math.cos(Math.toRadians(lat2)) *
                        Math.sin(dbLongitudeDiff / 2) * Math.sin(dbLongitudeDiff / 2);

        double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        double d = dbRadiusMeters * c /1000;
        return d;
    }

    //Fungsi menampilkan jarak ke hotel
    private void hitungJarak(){
        //jarakKeHotel = distFrom(Home.selfLat, Home.selfLng, saveLatHotel, saveLngHotel);
        jarakKeTpKuliner = distFrom(Home.selfLat, Home.selfLng,saveLatTpKuliner, saveLngTpKuliner);
        Log.d("jarak", String.valueOf(jarakKeTpKuliner));
        tvDesJarakKuliner.setText("± "+ new DecimalFormat("##.##").format(jarakKeTpKuliner) +" KM");
        //tvDesJarak.setText(String.valueOf(jarakKeHotel));
    }



    private void getLastLocation() {
        if (ActivityCompat.checkSelfPermission(DeskripsiTpKuliner.this, ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {

            return;
        }
        fusedLocationProviderClient.getLastLocation().addOnSuccessListener(DeskripsiTpKuliner.this, new OnSuccessListener<Location>() {
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

    private void setMapMarker() {
        /*LatLng latLng = new LatLng(selfLat, selfLng);
        MarkerOptions markerOptions = new MarkerOptions();
        markerOptions.position(latLng);
        markerOptions.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED));
        markerOptions.title("Posisi Anda Saat Ini");
        markerOptions.snippet(selfLat + ", " + selfLng);
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng));
        mMap.addMarker(markerOptions);*/

        //halte transJ//sudirman 2
        LatLng latLng1 = new LatLng(-7.782985 , 110.369177);
        MarkerOptions markerOptions1 = new MarkerOptions();
        markerOptions1.position(latLng1);
        markerOptions1.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions1.title("Transjogja Sudirman 2");
        markerOptions1.snippet("Gowongan, Kec. Jetis, Kota Yogyakarta (ht santika)");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng1, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng1));
        mMap.addMarker(markerOptions1);

        //halte transJ//sudirman 3
        LatLng latLng2 = new LatLng(-7.782839 , 110.368891);
        MarkerOptions markerOptions2 = new MarkerOptions();
        markerOptions2.position(latLng2);
        markerOptions2.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions2.title("Transjogja Sudirman 3");
        markerOptions2.snippet("Cokrodiningratan, Kec. Jetis, Kota Yogyakarta");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng2, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng2));
        mMap.addMarker(markerOptions2);

        //Halte UTY
        LatLng latLng3 = new LatLng(-7.7473875739074165 , 110.3564273236193);
        MarkerOptions markerOptions3 = new MarkerOptions();
        markerOptions3.position(latLng3);
        markerOptions3.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions3.title("Halte UTY");
        markerOptions3.snippet("Mlati Krajan, Sendangadi, Kec. Mlati, Kabupaten Sleman Yogyakarta");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng3, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng3));
        mMap.addMarker(markerOptions3);

        //Halte Transjogja TVRI
        LatLng latLng4 = new LatLng(-7.765172 , 110.361686);
        MarkerOptions markerOptions4 = new MarkerOptions();
        markerOptions4.position(latLng4);
        markerOptions4.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions4.title("Halte Transjogja TVRI");
        markerOptions4.snippet("Ruko Permai Magelang, Jl. Magelang No.8, Kutu Asem, Sinduadi, Kec. Mlati, Kabupaten Sleman.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng4, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng4));
        mMap.addMarker(markerOptions4);

        //Halte Trans Jogja Bandara Adisucipto
        LatLng latLng5 = new LatLng(-7.784597 , 110.431610);
        MarkerOptions markerOptions5 = new MarkerOptions();
        markerOptions5.position(latLng5);
        markerOptions5.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions5.title("Halte Trans Jogja Bandara Adisucipto");
        markerOptions5.snippet("Jl. Airport Adisucipto, Karangploso, Maguwoharjo, Kec. Depok, Kabupaten Sleman, Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng5, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng5));
        mMap.addMarker(markerOptions5);

        //Halte Jlagran
        LatLng latLng6 = new LatLng(-7.789441 , 110.360220);
        MarkerOptions markerOptions6 = new MarkerOptions();
        markerOptions6.position(latLng6);
        markerOptions6.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions6.title("Halte Jlagran");
        markerOptions6.snippet("Jl. Ps. Kembang, Pringgokusuman, Gedong Tengen, Kota Yogyakarta, Daerah Istimewa Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng6, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng6));
        mMap.addMarker(markerOptions6);

        //Halte Malioboro 1
        LatLng latLng7 = new LatLng(-7.790839 , 110.366160);
        MarkerOptions markerOptions7 = new MarkerOptions();
        markerOptions7.position(latLng7);
        markerOptions7.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions7.title("Halte Malioboro 1");
        markerOptions7.snippet("Jl. Malioboro, Sosromenduran, Gedong Tengen, Kota Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng7, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng7));
        mMap.addMarker(markerOptions7);

        //Halte Cik Di Tiro 1
        LatLng latLng8 = new LatLng(-7.782341 , 110.375101);
        MarkerOptions markerOptions8 = new MarkerOptions();
        markerOptions8.position(latLng8);
        markerOptions8.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions8.title("Halte Cik Di Tiro 1");
        markerOptions8.snippet("Jl. Cik Di Tiro, Terban, Kec. Gondokusuman, Kota Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng8, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng8));
        mMap.addMarker(markerOptions8);

        //Halte TJ Yos Sudarso
        LatLng latLng9 = new LatLng(-7.787291 , 110.375375);
        MarkerOptions markerOptions9 = new MarkerOptions();
        markerOptions9.position(latLng9);
        markerOptions9.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions9.title("Halte TJ Yos Sudarso");
        markerOptions9.snippet("Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng9, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng9));
        mMap.addMarker(markerOptions9);

        //Halte Trans Jogja Malioboro 3
        LatLng latLng10 = new LatLng(-7.800004 , 110.365022);
        MarkerOptions markerOptions10 = new MarkerOptions();
        markerOptions10.position(latLng10);
        markerOptions10.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions10.title("Halte Trans Jogja Malioboro 3");
        markerOptions10.snippet("Ngupasan, Kec. Gondomanan, Kota Yogyakarta, Daerah Istimewa Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng10, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng10));
        mMap.addMarker(markerOptions10);

        //Halte Trans Jogja Museum Perjuangan
        LatLng latLng11 = new LatLng(-7.814861 , 110.371383);
        MarkerOptions markerOptions11 = new MarkerOptions();
        markerOptions11.position(latLng10);
        markerOptions11.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions11.title("Halte Trans Jogja Museum Perjuangan");
        markerOptions11.snippet("Jl. Kolonel Sugiyono No.29, Brontokusuman, Kec. Mergangsan, Kota Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng11, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng11));
        mMap.addMarker(markerOptions11);

        //Halte Trans Jogja Katamso 1
        LatLng latLng12 = new LatLng(-7.808752 , 110.369157);
        MarkerOptions markerOptions12 = new MarkerOptions();
        markerOptions12.position(latLng12);
        markerOptions12.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions12.title("Halte Trans Jogja Katamso 1");
        markerOptions12.snippet("Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng12, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng12));
        mMap.addMarker(markerOptions12);

        //Halte Transjogja Taman Siswa
        LatLng latLng13 = new LatLng(-7.813688 , 110.376553);
        MarkerOptions markerOptions13 = new MarkerOptions();
        markerOptions13.position(latLng13);
        markerOptions13.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions13.title("Halte Transjogja Taman Siswa");
        markerOptions13.snippet("Jl. Taman Siswa, Wirogunan, Kec. Mergangsan, Kota Yogyakarta, Daerah Istimewa Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng13, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng13));
        mMap.addMarker(markerOptions13);

        //Trans Jogja bus stop Mandala Krida Stadium
        LatLng latLng14 = new LatLng(-7.797536 , 110.383399);
        MarkerOptions markerOptions14 = new MarkerOptions();
        markerOptions14.position(latLng14);
        markerOptions14.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions14.title("Trans Jogja bus stop Mandala Krida Stadium");
        markerOptions14.snippet("Jl. Kenari No.6, Semaki, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng14, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng14));
        mMap.addMarker(markerOptions14);

        //Halte TransJogja Gedongkuning
        LatLng latLng15 = new LatLng(-7.807293 , 110.402203);
        MarkerOptions markerOptions15 = new MarkerOptions();
        markerOptions15.position(latLng15);
        markerOptions15.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_CYAN));
        markerOptions15.title("Halte TransJogja Gedongkuning");
        markerOptions15.snippet("Jl. Gedongkuning No.173, Banguntapan, Kec. Banguntapan, Kota Yogyakarta.");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng15, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng15));
        mMap.addMarker(markerOptions15);

        //lokasi hotel
        LatLng latLnghotel = new LatLng(saveLatTpKuliner, saveLngTpKuliner);
        MarkerOptions markerOptions = new MarkerOptions();
        markerOptions.position(latLnghotel);
        markerOptions.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_RED));
        markerOptions.title(saveNamaTpKuliner);
        markerOptions.snippet(saveAlamatTpKuliner);
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLnghotel, 17));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLnghotel));
        mMap.addMarker(markerOptions);
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        /*mMap.getUiSettings().setAllGesturesEnabled(true);*/
        mMap.getUiSettings().setZoomControlsEnabled(true);
        mMap.setMinZoomPreference(10);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
            if (ActivityCompat.checkSelfPermission(DeskripsiTpKuliner.this, ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
                    && ActivityCompat.checkSelfPermission(DeskripsiTpKuliner.this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                ActivityCompat.requestPermissions(DeskripsiTpKuliner.this, new String[]{ACCESS_FINE_LOCATION
                        , Manifest.permission.ACCESS_COARSE_LOCATION}, 1);
            } else {
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
                Toast.makeText(DeskripsiTpKuliner.this, "Permission Granted", Toast.LENGTH_SHORT).show();
                if (ActivityCompat.checkSelfPermission(DeskripsiTpKuliner.this, ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED
                        && ActivityCompat.checkSelfPermission(DeskripsiTpKuliner.this, Manifest.permission.ACCESS_COARSE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
                    mMap.setMyLocationEnabled(true);
                }
            } else {
                Toast.makeText(DeskripsiTpKuliner.this, "Permission Denied", Toast.LENGTH_SHORT).show();
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
        Toast.makeText(DeskripsiTpKuliner.this, "Lokasiku saat ini : " + location, Toast.LENGTH_LONG).show();
    }

}
