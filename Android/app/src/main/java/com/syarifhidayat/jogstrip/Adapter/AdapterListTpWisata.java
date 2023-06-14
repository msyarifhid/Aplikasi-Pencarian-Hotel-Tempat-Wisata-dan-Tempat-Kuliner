package com.syarifhidayat.jogstrip.Adapter;

import android.content.Context;
import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Filter;
import android.widget.Filterable;
import android.widget.ImageView;
import android.widget.TextView;
import com.bumptech.glide.Glide;
import com.syarifhidayat.jogstrip.Activity.DeskripsiTpWisata;
import com.syarifhidayat.jogstrip.Activity.Home;
import com.syarifhidayat.jogstrip.ApiClient;
import com.syarifhidayat.jogstrip.Getter.TempatWisatas;
import com.syarifhidayat.jogstrip.R;

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.ArrayList;
import java.util.List;

//import com.syarifhidayat.jogjatravel.Getter.TpWisatas;

//import com.syarifhidayat.jogjatravel.MapFragmentTpWisata;

public class AdapterListTpWisata extends RecyclerView.Adapter<AdapterListTpWisata.Holder> implements Filterable {
    private Context context;
    private List<TempatWisatas> listTpWisatas;
    double jarakKeWisata;
    List<TempatWisatas> filterList;

    public AdapterListTpWisata(Context context, List<TempatWisatas> tpWisatas) {
        this.context = context;
        this.listTpWisatas = tpWisatas;
        filterList = listTpWisatas;
    }

    @NonNull
    @Override
    public Holder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(context).inflate(R.layout.layout_list_tpwisata,parent,false);
        Holder holder = new Holder(view);
        return holder;
    }

    @Override
    public void onBindViewHolder(@NonNull final Holder holder, final int position) {

        holder.tv_namaTpWisata.setText(listTpWisatas.get(position).getNama_tpwisata());
        holder.tv_alamatTpWisata.setText(listTpWisatas.get(position).getAlamat());
        holder.tv_listhargaWisata.setText("Rp. " + FormatAngka(listTpWisatas.get(position).getHarga_tiket()));
        double lat = listTpWisatas.get(position).getLatitude();
        double longt = listTpWisatas.get(position).getLongitude();
        holder.tv_listjarakWisata.setText("± "+ new DecimalFormat("##.##").format(hitungJarak(lat, longt)) + " KM");

        Glide.with(context).load(ApiClient.IMAGEWISATA_URL + listTpWisatas.get(position)
                .getGambar()).error(R.mipmap.ic_launcher).into(holder.imgTpWisata);
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent i = new Intent(context, DeskripsiTpWisata.class);

                i.putExtra("namaTpWisata", listTpWisatas.get(position).getNama_tpwisata());
                i.putExtra("idTpWisata", listTpWisatas.get(position).getId_tpwisata());
                //openMapFragment();
                i.putExtra("alamatTpWisata", listTpWisatas.get(position).getAlamat());
                i.putExtra("gambarTpWisata", listTpWisatas.get(position).getGambar());
                i.putExtra("deskripsiTpWisata", listTpWisatas.get(position).getDeskripsi());
                i.putExtra("latTpWisata", listTpWisatas.get(position).getLatitude());
                i.putExtra("lngTpWisata", listTpWisatas.get(position).getLongitude());

                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                context.startActivity(i);

            }
        });
    }

    public String FormatAngka(int angka) {
        NumberFormat nf = new DecimalFormat("#,##0");
        return nf.format(angka);
    }

    @Override
    public int getItemCount() {
        return listTpWisatas.size();
    }


    public class Holder extends RecyclerView.ViewHolder {
        private ImageView imgTpWisata;
        private TextView tv_namaTpWisata, tv_alamatTpWisata, tv_listhargaWisata, tv_listjarakWisata;

        public Holder(View itemView) {
            super(itemView);

            imgTpWisata = itemView.findViewById(R.id.imgTpWisata);
            tv_namaTpWisata = itemView.findViewById(R.id.tv_namaTpWisata);
            tv_alamatTpWisata = itemView.findViewById(R.id.tv_alamatTpWisata);
            tv_listhargaWisata = itemView.findViewById(R.id.tv_listhargaWisata);
            tv_listjarakWisata = itemView.findViewById(R.id.tv_listjarakWisataaa);

        }
    }

    @Override
    public Filter getFilter() {

        return new Filter() {
            @Override
            protected FilterResults performFiltering(CharSequence constraint) {
                String charString = constraint.toString();
                if(charString.isEmpty())
                {
                    listTpWisatas = filterList;
                }
                else
                {
                    List<TempatWisatas> mListTpWisata = new ArrayList<>();
                    for (TempatWisatas data : filterList)
                    {
                        if(data.getNama_tpwisata().toLowerCase().contains(charString))
                        {
                            mListTpWisata.add(data);
                        }
                    }
                    listTpWisatas = mListTpWisata;
                }
                FilterResults filterResults = new FilterResults();
                filterResults.values = listTpWisatas;
                return filterResults;
            }

            @Override
            protected void publishResults(CharSequence constraint, FilterResults results) {
                listTpWisatas = (List<TempatWisatas>) results.values;
                notifyDataSetChanged();
            }
        };
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
    private double hitungJarak(double latitude, double longitude){
        //jarakKeHotel = distFrom(Home.selfLat, Home.selfLng, saveLatHotel, saveLngHotel);
        jarakKeWisata = distFrom(Home.selfLat, Home.selfLng, latitude, longitude);
        Log.d("jarak", String.valueOf(jarakKeWisata));
        return jarakKeWisata;
    }

}
