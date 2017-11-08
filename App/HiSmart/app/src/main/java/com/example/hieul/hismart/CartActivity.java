package com.example.hieul.hismart;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.database.Cursor;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.List;

public class CartActivity extends AppCompatActivity {

    public int count = 0;
    Button thanhtoan, goimon;
    final static boolean tt_thanhtoan = true;
    public ListView listViewMon;
    private Context ctx;
    Db db = new Db(this);
    List<String> ArrTenmon = new ArrayList<String>();
    List<String> ArrGia = new ArrayList<String>();
    List<String> ArrImgUrl = new ArrayList<String>();
    List<String> ArrIDMon = new ArrayList<String>();
    List<String> ArrIDTable = new ArrayList<String>();
    List<CartGetSetListView> listtao = new ArrayList<CartGetSetListView>();
    CartArrayAdapter myadapter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_cart);

        this.setFinishOnTouchOutside(true);

        thanhtoan = (Button) findViewById(R.id.thanhtoan);
        goimon = (Button) findViewById(R.id.goimon);
        setContentView(R.layout.activity_cart);
        listViewMon = (ListView) findViewById(R.id.lvmon);

        // load data from table order
        load_cart();


        //  listViewMon.setAdapter(new CartArrayAdapter(ctx, R.layout.single_list_cart, listtao));

         myadapter = new CartArrayAdapter(ctx, R.layout.single_list_cart, listtao);
        listViewMon.setAdapter(myadapter);

        listViewMon.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public String variable;

            @Override
            public void onItemClick(final AdapterView<?> adapterView, View view, final int position, long l) {
                CartGetSetListView o = (CartGetSetListView) adapterView.getItemAtPosition(position);
                variable = o.getTenmon().toString();

                //Toast.makeText(CartActivity.this, variable + "" + position, Toast.LENGTH_SHORT).show();

                AlertDialog.Builder alertDialog = new AlertDialog.Builder(
                        CartActivity.this);
                // Setting Dialog Title
                alertDialog.setTitle("XÓA MÓN");
                // Setting Dialog Message
                alertDialog.setMessage("Bạn có muốn xóa " + "[" + variable + "]" + String.valueOf(position) + " khỏi giỏ hàng?");
                // Setting Icon to Dialog
                alertDialog.setIcon(R.drawable.warning);
                // Setting Positive "Yes" Button
                alertDialog.setPositiveButton("YES",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                                listtao.remove(position);
                                myadapter.notifyDataSetChanged();
                                int idxoa = position + 1;
                                db.delete_order("tbl_order", String.valueOf(idxoa));

                                
//                                for (int i = 1; i <= idxoa; i++) {
//                                    db.querydata("insert into tbl_order values('" + i + "',null, null, null, null, null )");
//                                    db.close();
//                                }
                               // load_cart();

                            }
                        });

                // Showing Alert Message
                alertDialog.show();


            }


        });
//
    }

    @Override
    public void onBackPressed() {
        finish();
    }

    public void load_cart() {


        ctx = this;
        db.querydata("Create table if not exists tbl_order (ID_book integer primary key, IDCH_book integer not null, ID_table integer not null, IDmon_book integer not null, TT_tt text not null, Datetime_book tex not null)");
        Cursor curs = db.getdata("select * from tbl_order, tbl_mon_app where tbl_order.IDmon_book = tbl_mon_app.IDMon");
        int cc = curs.getCount();
        if (curs.moveToFirst()) {

            while (!curs.isAfterLast()) {

                // Toast.makeText(BookActivity.this, cur.getString(cur.getColumnIndex("TenMon")), Toast.LENGTH_SHORT).show();
                ArrImgUrl.add(curs.getString(curs.getColumnIndex("ImgUrl")));
                curs.moveToNext();

            }
        }
        if (curs.moveToFirst()) {

            while (!curs.isAfterLast()) {

                // Toast.makeText(BookActivity.this, cur.getString(cur.getColumnIndex("TenMon")), Toast.LENGTH_SHORT).show();
                ArrTenmon.add(curs.getString(curs.getColumnIndex("TenMon")));
                curs.moveToNext();

            }
        }
        if (curs.moveToFirst()) {

            while (!curs.isAfterLast()) {

                // Toast.makeText(BookActivity.this, cur.getString(cur.getColumnIndex("TenMon")), Toast.LENGTH_SHORT).show();
                ArrGia.add(curs.getString(curs.getColumnIndex("Gia")));
                curs.moveToNext();

            }
        }

        for (int i = 0; i < cc; i++) {

            listtao.add(new CartGetSetListView(ArrImgUrl.get(i), ArrTenmon.get(i), ArrGia.get(i), "delete1"));
           // myadapter.setNotifyOnChange(true);
        }
        curs.close();
        db.close();
    }

}