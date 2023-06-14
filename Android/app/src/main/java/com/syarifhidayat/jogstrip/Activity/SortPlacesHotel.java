package com.syarifhidayat.jogstrip.Activity;

import com.google.android.gms.maps.model.LatLng;
import com.syarifhidayat.jogstrip.Getter.Hotels;

import java.util.Comparator;

public class SortPlacesHotel implements Comparator<Hotels>{
        LatLng currentLoc;

        public SortPlacesHotel(LatLng current){
            currentLoc = current;
        }
        @Override
        public int compare(final Hotels place1, final Hotels place2) {
            double lat1 = place1.getLatitude();
            double lon1 = place1.getLongitude();
            double lat2 = place2.getLatitude();
            double lon2 = place2.getLongitude();

            double distanceToPlace1 = distance(currentLoc.latitude, currentLoc.longitude, lat1, lon1);
            double distanceToPlace2 = distance(currentLoc.latitude, currentLoc.longitude, lat2, lon2);
            return (int) (distanceToPlace1 - distanceToPlace2);
        }

        public double distance(double fromLat, double fromLon, double toLat, double toLon) {
        /*double radius = 6378137;   // approximate Earth radius, *in meters*
        double deltaLat = toLat - fromLat;
        double deltaLon = toLon - fromLon;
        double angle = 2 * Math.asin( Math.sqrt(
                Math.pow(Math.sin(deltaLat/2), 2) +
                        Math.cos(fromLat) * Math.cos(toLat) *
                                Math.pow(Math.sin(deltaLon/2), 2) ) );
        return radius * angle;*/
            double dbRadiusMeters = 6378137 ; // Earth’s mean radius in meter
            double dbLatitudeDiff = Math.toRadians(toLat - fromLat);
            double dbLongitudeDiff = Math.toRadians(toLon - fromLon);

            double a = Math.sin(dbLatitudeDiff / 2) * Math.sin(dbLatitudeDiff / 2) +
                    Math.cos(Math.toRadians(fromLat)) * Math.cos(Math.toRadians(toLat)) *
                            Math.sin(dbLongitudeDiff / 2) * Math.sin(dbLongitudeDiff / 2);

            double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            double d = dbRadiusMeters * c;
            return d;
        }
    }
