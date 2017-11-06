package com.example.hieul.hismart;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.List;

public class CartActivity extends AppCompatActivity {

    public int count = 0;
    Button thanhtoan, goimon;
    final static boolean tt_thanhtoan = true;
    public ListView listViewMon;
    private Context ctx;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_cart);

        this.setFinishOnTouchOutside(true);

        thanhtoan = (Button) findViewById(R.id.thanhtoan);
        goimon = (Button) findViewById(R.id.goimon);

//        if (tt_thanhtoan) {
            thanhtoan.setEnabled(false);
            goimon.setEnabled(false);
//        } else {
//            thanhtoan.setEnabled(true);
//            goimon.setEnabled(true);
//        }

        setContentView(R.layout.activity_cart);

        ctx = this;

        List<CartGetSetListView> listtao = new ArrayList<CartGetSetListView>();
        listtao.add(new CartGetSetListView("album1", "ốc xào me", "Giá: 150.000", "delete1"));
        listtao.add(new CartGetSetListView("album2", "gà hấp muối hột", "Giá: 150.000", "delete1"));
        listtao.add(new CartGetSetListView("album3", "cút quay", "Giá: 150.000", "delete1"));
        listtao.add(new CartGetSetListView("album4", "baba xào lăn", "Giá: 150.000", "delete1"));
        listtao.add(new CartGetSetListView("album5", "cháo trai", "Giá: 150.000", "delete1"));
        listtao.add(new CartGetSetListView("album6", "gà quay tiêu chanh", "Giá: 150.000", "delete1"));

        listViewMon = (ListView) findViewById(R.id.lvmon);
        listViewMon.setAdapter(new CartArrayAdapter(ctx, R.layout.single_list_cart, listtao));

        // Click event for single list row


        listViewMon.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            public String variable;

            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, final int position, long l) {
                CartGetSetListView o = (CartGetSetListView) adapterView.getItemAtPosition(position);
                variable = o.getTenmon().toString();

                Toast.makeText(CartActivity.this, variable + "" + position, Toast.LENGTH_SHORT).show();

                AlertDialog.Builder alertDialog = new AlertDialog.Builder(
                        CartActivity.this);
                // Setting Dialog Title
                alertDialog.setTitle("XÓA MÓN");
                // Setting Dialog Message
                alertDialog.setMessage( "Bạn có muốn xóa " + "[" + variable + "]" + " khỏi giỏ hàng?");
                // Setting Icon to Dialog
                alertDialog.setIcon(R.drawable.warning);
                // Setting Positive "Yes" Button
                alertDialog.setPositiveButton("YES",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {

                                Toast.makeText(CartActivity.this, "Đã xóa: " + variable, Toast.LENGTH_SHORT).show();
                            }
                        });

                // Showing Alert Message
                alertDialog.show();


            }


        });
//
    }

}