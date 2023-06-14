package com.syarifhidayat.jogstrip.Adapter;//package com.syarifhidayat.jogjatravel.Adapter;
//
//import android.content.Context;
//import android.support.v7.widget.RecyclerView;
//import android.view.LayoutInflater;
//import android.view.View;
//import android.view.ViewGroup;
//import android.widget.TextView;
//
//import com.syarifhidayat.jogjatravel.Getter.Hotels;
//import com.syarifhidayat.jogjatravel.R;
//
//import java.util.List;
//
//public class AdapterSearchHotel extends RecyclerView.Adapter<AdapterSearchHotel.MyViewHolder> {
//
//    private List<Hotels> hotels;
//    private Context context;
//
//    public AdapterSearchHotel(List<Hotels> hotels, Context context) {
//        this.hotels = hotels;
//        this.context = context;
//    }
//
//
//    @Override
//    public MyViewHolder onCreateViewHolder( ViewGroup parent, int viewType) {
//        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item, parent, false);
//        return new MyViewHolder(view);
//    }
//
//    @Override
//    public void onBindViewHolder( MyViewHolder holder, int position) {
//
//        holder.hotel.setText(hotels.get(position).getNama_hotel());
//        holder.fasilitas.setText(hotels.get(position).getFasilitas());
//
//    }
//
//    @Override
//    public int getItemCount() {
//        return hotels.size();
//    }
//
//    public static class MyViewHolder extends RecyclerView.ViewHolder{
//
//        TextView hotel, fasilitas;
//
//        public MyViewHolder(View itemView){
//            super(itemView);
//
//            hotel = itemView.findViewById(R.id.hotel);
//            fasilitas = itemView.findViewById(R.id.fasilitas);
//
//        }
//    }
//}
//
