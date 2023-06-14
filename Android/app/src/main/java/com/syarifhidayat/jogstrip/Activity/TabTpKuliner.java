package com.syarifhidayat.jogstrip.Activity;

import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.view.MenuItemCompat;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.SearchView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.ProgressBar;
import android.widget.Toast;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.tasks.OnSuccessListener;
import com.syarifhidayat.jogstrip.Adapter.AdapterListTpKuliner;
import com.syarifhidayat.jogstrip.ApiClient;
import com.syarifhidayat.jogstrip.ApiInterface;
import com.syarifhidayat.jogstrip.Getter.TempatKuliners;
import com.syarifhidayat.jogstrip.R;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;

import static android.Manifest.permission.ACCESS_FINE_LOCATION;

//import com.syarifhidayat.jogjatravel.Adapter.AdapterSearchTpKuliner;

public class TabTpKuliner extends AppCompatActivity {

    //private static final String ACCESS_FINE_LOCATION = 1;
    public static final int RequestPermissionCode = 1;
    View btn_tpKulinerSekitar, btn_tpKulinerAll;
    double selfLat, selfLng;
    String myLocation;

    private GoogleApiClient googleApiClient;
    private FusedLocationProviderClient fusedLocationProviderClient;

    private RecyclerView rv_searchTpKuliner, rv_listTpKuliner;
    private RecyclerView.LayoutManager layoutManager1, layoutManager2;
    private List<TempatKuliners> tpKuliners;
    private List<TempatKuliners> tempatKulinersAll;
    //private AdapterSearchTpKuliner adapterSearchTpKuliner;
    private AdapterListTpKuliner adapterListTpKuliner;
    private ApiInterface apiInterface;
    ProgressBar progressBar;
    private Toolbar toolbarTpKuliner;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tab_tpkuliner);

        //menerapkan tool bar sesuai id toolbar | ToolBarAtas adalah variabel buatan sndiri
        Toolbar ToolBarAtas2 = findViewById(R.id.toolbar_tabKuliner);
        setSupportActionBar(ToolBarAtas2);
        //ToolBarAtas2.setLogo(R.mipmap.ic_launcher);
        ToolBarAtas2.setLogoDescription(getResources().getString(R.string.app_name));
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ToolBarAtas2.setNavigationOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        startActivity(new Intent(getApplicationContext(),Home.class));
                    }
                }
        );

        requestPermission();
        fusedLocationProviderClient = LocationServices.getFusedLocationProviderClient(this);

        btn_tpKulinerSekitar = findViewById(R.id.btn_tpKulinerSekitar);
        btn_tpKulinerAll = findViewById(R.id.btn_tpKulinerAll);

        progressBar = findViewById(R.id.progress);
        rv_listTpKuliner = findViewById(R.id.rv_listTpKuliner);
        rv_searchTpKuliner = findViewById(R.id.rv_searchTpKuliner);
        layoutManager1 = new LinearLayoutManager(this);
        layoutManager2 = new LinearLayoutManager(this);

        rv_listTpKuliner.setLayoutManager(layoutManager2);
        rv_searchTpKuliner.setLayoutManager(layoutManager1);


        //getLast location
        getLastLocation();

        btn_tpKulinerAll.setOnClickListener(v -> {
            tpKuliners.clear();
            tpKuliners.addAll(tempatKulinersAll);
            LatLng current = new LatLng(Home.selfLat, Home.selfLng);
            Collections.sort(tpKuliners, new SortPlacesKuliner(current));
            adapterListTpKuliner.notifyDataSetChanged();
        });

        btn_tpKulinerSekitar.setOnClickListener(v -> {

            tpKuliners.clear();
            for (TempatKuliners h : tempatKulinersAll) {
                if (distFrom(h.getLatitude(), h.getLongitude(), selfLat, selfLng) <= 2.5) {
                    tpKuliners.add(h);
                    LatLng current = new LatLng(Home.selfLat, Home.selfLng);
                    Collections.sort(tpKuliners, new SortPlacesKuliner(current));
                }
            }

            adapterListTpKuliner.notifyDataSetChanged();
        });

        toolbarTpKuliner = findViewById(R.id.toolbarTpKuliner);

        setSupportActionBar(toolbarTpKuliner);

        tpKuliners = new ArrayList<>();
        tempatKulinersAll = new ArrayList<>();
        adapterListTpKuliner = new AdapterListTpKuliner(TabTpKuliner.this, tpKuliners);
        rv_listTpKuliner.setAdapter(adapterListTpKuliner);
        showListTpKuliners("");
    }

    private void getLastLocation() {
        if (ActivityCompat.checkSelfPermission(TabTpKuliner.this, ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {

            return;
        }
        fusedLocationProviderClient.getLastLocation().addOnSuccessListener(TabTpKuliner.this, new OnSuccessListener<Location>() {
            @Override
            public void onSuccess(Location location) {

                if (location != null){
                    //myLocation = location.toString();
                    selfLat = location.getLatitude();
                    selfLng = location.getLongitude();
                }

                Log.d("lokasi", "Latitude: " + selfLat);
                Log.d("lokasi", "Longitude: " + selfLng);
            }
        });
    }

    private void requestPermission(){
        ActivityCompat.requestPermissions(TabTpKuliner.this, new String[]{ACCESS_FINE_LOCATION}, 1);
    }

    private void showListTpKuliners (String key){
        apiInterface = ApiClient.getApiClient().create(ApiInterface.class);
        Call<List<TempatKuliners>> call = apiInterface.getTpKuliners(key);

        call.enqueue(new Callback<List<TempatKuliners>>() {
            @Override
            public void onResponse(Call<List<TempatKuliners>> call, Response<List<TempatKuliners>> response) {
                progressBar.setVisibility(View.GONE);
                tempatKulinersAll.clear();
                tempatKulinersAll.addAll(response.body());
                tpKuliners.clear();
                tpKuliners.addAll(response.body());

                LatLng current = new LatLng(Home.selfLat, Home.selfLng);
                Collections.sort(tpKuliners, new SortPlacesKuliner(current));
                adapterListTpKuliner.notifyDataSetChanged();
            }

            @Override
            public void onFailure(Call<List<TempatKuliners>> call, Throwable t) {
                progressBar.setVisibility(View.GONE);
                Toast.makeText(TabTpKuliner.this, "Error\n : " + t.toString(), Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.search_tpKuliner) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_tpkuliner, menu);
        MenuItem searchItem = menu.findItem(R.id.search_tpKuliner);
        SearchView searchView = (SearchView) MenuItemCompat.getActionView(searchItem);
        search(searchView);
        return true;
    }

    private void search(SearchView searchView)
    {
        searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                adapterListTpKuliner.getFilter().filter(newText);
                return true;
            }
        });
    }

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

}

class LocationComparatorKuliner implements Comparator<Location>
{
    Location origin;
    public LocationComparatorKuliner(Location origin){
        this.origin= origin;
    }

    public int compare(Location left, Location right) {
        return Float.compare(origin.distanceTo(left), origin.distanceTo(right));
    }
}
