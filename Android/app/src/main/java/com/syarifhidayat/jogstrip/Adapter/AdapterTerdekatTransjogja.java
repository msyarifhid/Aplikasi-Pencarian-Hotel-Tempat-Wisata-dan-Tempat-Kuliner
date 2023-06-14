package com.syarifhidayat.jogstrip.Adapter;/*
package com.syarifhidayat.jogjatravel.Adapter;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.PorterDuff;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import com.syarifhidayat.jogjatravel.Activity.DeskripsiHotel;
import com.syarifhidayat.jogjatravel.Activity.DeskripsiTpKuliner;
//import com.syarifhidayat.jogjatravel.Activity.DeskripsiTransjogja;
//import com.syarifhidayat.jogjatravel.BasePlace;
import com.syarifhidayat.jogjatravel.BasePlaceTransjogja;
import com.syarifhidayat.jogjatravel.Getter.Hotels;
import com.syarifhidayat.jogjatravel.Getter.Transjogjas;
import com.syarifhidayat.jogjatravel.R;

import java.text.DecimalFormat;
import java.util.List;

public class AdapterTerdekatTransjogja extends RecyclerView.Adapter<AdapterTerdekatTransjogja.ViewwHolder> {

    Context context;
    List<BasePlaceTransjogja> listBasePlaceTransjogja;
    private List<Transjogjas> transjogjasList;
    String namaHotelTerdekat;

    public AdapterTerdekatTransjogja(Context context, List<BasePlaceTransjogja> listBasePlaceTransjogja) {
        this.context = context;
        this.listBasePlaceTransjogja = listBasePlaceTransjogja;
    }

    @NonNull
    @Override
    public ViewwHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        return new ViewwHolder(LayoutInflater.from(context).inflate(R.layout.layout_item_terdekat_transjogja, parent, false));

    }

    @Override
    public void onBindViewHolder(@NonNull ViewwHolder holder, int position) {


        BasePlaceTransjogja bP = listBasePlaceTransjogja.get(position);
        holder.tv_jarakTerdekatTransjogja.setText(new DecimalFormat("#.##").format(bP.getJarakTerdekat())+ "  Kilometer");
        holder.tv_tempatTerdekatTransjogja.setText(bP.getNamaTerdekat());

        holder.icTerdekatTransjogja.setColorFilter(Color.CYAN, PorterDuff.Mode.SRC_ATOP);

if (bP.getJenis().equals("transjogja")){
            holder.icTerdekatTransjogja.setColorFilter(Color.CYAN, PorterDuff.Mode.SRC_ATOP);
        }else if(bP.getJenis().equals("tempat_wisata")){
            holder.icTerdekatTransjogja.setColorFilter(Color.BLUE, PorterDuff.Mode.SRC_ATOP);
        }else if(bP.getJenis().equals("tempat_kuliner")){
            holder.icTerdekatTransjogja.setColorFilter(Color.YELLOW, PorterDuff.Mode.SRC_ATOP);
        }


        //click to deskripsiTerdekat
        holder.ly_itemTerdekatTransjogja.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //Toast.makeText(context, "KLIK TEMPAT TERDEKAT >", Toast.LENGTH_LONG).show();

            }
        });
    }

    @Override
    public int getItemCount() {
        return listBasePlaceTransjogja.size();
    }

    static class ViewwHolder extends RecyclerView.ViewHolder{

        ImageView icTerdekatTransjogja;
        TextView tv_tempatTerdekatTransjogja, tv_jarakTerdekatTransjogja;
        LinearLayout ly_itemTerdekatTransjogja;

        public ViewwHolder(View itemView) {
            super(itemView);

            icTerdekatTransjogja = itemView.findViewById(R.id.icTerdekatTransjogja);
            tv_tempatTerdekatTransjogja = itemView.findViewById(R.id.tv_tempatTerdekatTransjogja);
            tv_jarakTerdekatTransjogja = itemView.findViewById(R.id.tv_jarakTerdekatTransjogja);
            ly_itemTerdekatTransjogja = itemView.findViewById(R.id.ly_itemTerdekatTransjogja);
        }
    }
}
*/
