/*
package com.syarifhidayat.jogjatravel;


import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.syarifhidayat.jogjatravel.Activity.DeskripsiHotel;


*/
/**
 * A simple {@link Fragment} subclass.
 *//*

public class MapFragmentHotel extends Fragment implements OnMapReadyCallback {
    String markNamaHotel;

    GoogleMap mMap;
    SupportMapFragment mapFragment;
    public MapFragmentHotel() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        // Inflate the layout for this fragment
       View v =  inflater.inflate(R.layout.fragment_map_hotel, container, false);
        mapFragment = (SupportMapFragment) getChildFragmentManager().findFragmentById(R.id.map_desHotel);
        mapFragment.getMapAsync(this);

        if (getArguments() != null) {
            markNamaHotel = getArguments().getString("fragNamaHotel");
        }else{
            markNamaHotel = "NULL !";
        }

        return v;
    }

    @Override
    public void onMapReady(GoogleMap googleMap) {


        mMap = googleMap;

        LatLng latLng = new LatLng(-7.791455, 110.37415599999997);
        MarkerOptions markerOptions = new MarkerOptions();
        markerOptions.position(latLng);
        markerOptions.icon(BitmapDescriptorFactory.defaultMarker(BitmapDescriptorFactory.HUE_MAGENTA));
        markerOptions.title("tidak ada");
        markerOptions.snippet("nama jalan");
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, 16.0f));
        mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng));
        mMap.addMarker(markerOptions);
    }

}
*/
