package com.example.hieul.hismart;

import android.content.Intent;
import android.content.pm.PackageManager;
import android.location.Location;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationServices;
import com.google.zxing.integration.android.IntentIntegrator;
import com.google.zxing.integration.android.IntentResult;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.Date;

public class MainActivity extends AppCompatActivity implements GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener {


    String getch = "http://lengocminhhieu.ga/App/getjsonweb.php";

    Location Startpoint = new Location("Startpoint");
    Location Endpoint = new Location("Endpoint");
    Db db = new Db(this);
    Button btnScasnQR, btnGoback;
    TextView txtViewVitri, txtviewResult;
    String url = "http://lengocminhhieu.ga/App/KH_booking.php";
    String date = new SimpleDateFormat("yyyy-MM-dd").format(new Date());
    public static IntentResult resultQR;
    private Location location;
    private GoogleApiClient gac;
    public double latitude, longitude;
    double distance = 0;
    public String kinhdojon;
    public String vidojson;
    Long kd, vd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_main);


        final IntentIntegrator intentIntegrator = new IntentIntegrator(this);
        txtviewResult = (TextView) findViewById(R.id.textViewResult);
        txtViewVitri = (TextView) findViewById(R.id.textViewVitri);
        btnScasnQR = (Button) findViewById(R.id.btnScan);


        // Lấy vị trí
        if (checkPlayServices()) {
            // Building the GoogleApi client
            buildGoogleApiClient();

        }
//======== temp
//        Intent ii = new Intent(MainActivity.this, BookActivity.class);
//        startActivity(ii);

//=========temp

        //======================== note
//        btnGoback.setVisibility(View.INVISIBLE);
//
//        db.querydata("Create table if not exists tbl_order (ID_book integer primary key, IDCH_book integer not null, ID_table integer not null, IDmon_book integer not null, TT_tt text not null, Datetime_book tex not null)");
//
//        Cursor curs = db.getdata("select * from tbl_order");
//        int co = curs.getCount();
//        curs.close();

//        if (co > 0) {
//
//            btnScasnQR.setText("Click Here to Go Back");
//            btnScasnQR.setOnClickListener(new View.OnClickListener() {
//                @Override
//                public void onClick(View view) {
//                    Intent iii = new Intent(MainActivity.this, BookActivity.class);
//                    startActivity(iii);
//                    finish();
//                }
//            });
//        } else {

        btnScasnQR.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //intentIntegrator.setDesiredBarcodeFormats(IntentIntegrator.ONE_D_CODE_TYPES);
                intentIntegrator.setPrompt(" ");
                //intentIntegrator.setCameraId(0);  // Use a specific camera of the device
                intentIntegrator.setBeepEnabled(true);
                intentIntegrator.setBarcodeImageEnabled(false);
                intentIntegrator.setOrientationLocked(true);
                intentIntegrator.initiateScan();
//
            }
        });
//        }


//        btnGoback.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent a = new Intent(MainActivity.this, BookActivity.class);
//                startActivity(a);
//            }
//        });

        //===============================note

// tao data ban`
        // db.querydata("Create table if not exists lichsuDB (_ID integer primary key, TableID integer not null, Time text not null)");
        //Cursor loadarea = db.getdata("select * from Areas");


    }

    // lấy vị trí
    public void getLocation() {
        if (ActivityCompat.checkSelfPermission(this, android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            // Kiểm tra quyền hạn
            ActivityCompat.requestPermissions(this,
                    new String[]{android.Manifest.permission.ACCESS_COARSE_LOCATION}, 2);
        } else {
            location = LocationServices.FusedLocationApi.getLastLocation(gac);

            if (location != null) {
                latitude = location.getLatitude();
                longitude = location.getLongitude();


            }
        }
    }

    /**
     * Tạo đối tượng google api client
     */
    protected synchronized void buildGoogleApiClient() {
        if (gac == null) {
            gac = new GoogleApiClient.Builder(this)
                    .addConnectionCallbacks(this)
                    .addOnConnectionFailedListener(this)
                    .addApi(LocationServices.API).build();
        }
    }

    /**
     * Phương thức kiểm chứng google play services trên thiết bị
     */
    private boolean checkPlayServices() {
        int resultCode = GooglePlayServicesUtil.isGooglePlayServicesAvailable(this);
        if (resultCode != ConnectionResult.SUCCESS) {
            if (GooglePlayServicesUtil.isUserRecoverableError(resultCode)) {
                GooglePlayServicesUtil.getErrorDialog(resultCode, this, 1000).show();
            } else {
                Toast.makeText(this, "Thiết bị này không hỗ trợ.", Toast.LENGTH_LONG).show();
                finish();
            }
            return false;
        }
        return true;
    }

    @Override
    public void onConnected(@Nullable Bundle bundle) {
        // Đã kết nối với google api, lấy vị trí
        getLocation();
    }

    @Override
    public void onConnectionSuspended(int i) {
        gac.connect();
    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {
        Toast.makeText(this, "Lỗi kết nối: " + connectionResult.getErrorMessage(), Toast.LENGTH_SHORT).show();
    }

    protected void onStart() {
        gac.connect();
        super.onStart();
    }

    protected void onStop() {
        gac.disconnect();
        super.onStop();
    }


    // Get the results QR:
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        resultQR = IntentIntegrator.parseActivityResult(requestCode, resultCode, data);
        if (resultQR != null) {
            if (resultQR.getContents() == null) {
                Toast.makeText(this, "Cancelled", Toast.LENGTH_LONG).show();
            } else {

                // lấy vị trí và gửi vị trí
                getLocation();
                Getdatajson();


            }
        } else {
            super.onActivityResult(requestCode, resultCode, data);
        }
    }


    public void Getdatajson() {
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        StringRequest stringRequest = new StringRequest(Request.Method.GET, getch,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        if (response.equals("{\"AREA\":null}")) {
                            Toast.makeText(MainActivity.this, "kết nối mạng không ổn định", Toast.LENGTH_SHORT).show();
                        } else

                            try {
                                //1. Khai báo đối tượng json root object
                                JSONObject jsonRootObject = new JSONObject(response);
                                //2. Đưa jsonRootObject vào array object
                                JSONArray jsonArray = jsonRootObject.optJSONArray("AREA");
                                //3. Duyệt từng đối tượng trong Array và lấy giá trị ra
                                for (int i = 0; i < jsonArray.length(); i++) {
                                    JSONObject jsonObject = jsonArray.getJSONObject(i);
                                    boolean check = false;
                                    String idjson = jsonObject.optString("ID").toString();
                                    String TenCHjson = jsonObject.optString("TenCH").toString();
                                    kinhdojon = jsonObject.optString("kinhdo").toString();
                                    vidojson = jsonObject.optString("vido").toString();
                                    // Toast.makeText(MainActivity.this, kinhdojon + " " + vidojson, Toast.LENGTH_SHORT).show();
                                    Startpoint.setLatitude(latitude);
                                    Startpoint.setLongitude(longitude);
                                    Endpoint.setLatitude(Float.parseFloat(kinhdojon));
                                    Endpoint.setLongitude(Float.parseFloat(vidojson));
                                    distance = Startpoint.distanceTo(Endpoint);

                                    if ((distance <= 100) && (distance > 0)) {

                                        Intent ii = new Intent(MainActivity.this, BookActivity.class);
                                        startActivity(ii);
                                        finish();
                                    } else {
                                        Toast.makeText(MainActivity.this, "Bạn phải đến cửa hàng để gọi món!", Toast.LENGTH_LONG).show();
                                    }

                                }
                                ;
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(MainActivity.this, "Lỗi kết nối máy chủ", Toast.LENGTH_SHORT).show();
                        Log.d("Lỗi", "Lỗi" + "\n" + error.toString());
                    }
                }
        );
        requestQueue.add(stringRequest);
    }


}
