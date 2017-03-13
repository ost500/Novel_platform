package com.foxgarden.osteng.foxgarden;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;


import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.messaging.FirebaseMessaging;

public class MainActivity extends AppCompatActivity {

    private WebView mWebView;    // 웹뷰 선언
    private WebSettings mWebSettings;

    private class WishWebViewClient extends WebViewClient {

        @Override

        public boolean shouldOverrideUrlLoading(WebView view, String url) {

            view.loadUrl(url);

            return true;

        }

    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        mWebView = (WebView) findViewById(R.id.WebView1);


        mWebView.setWebViewClient(new WishWebViewClient());
        mWebSettings = mWebView.getSettings();
        mWebSettings.setJavaScriptEnabled(true);
//        mWebView.getSettings().setDefaultZoom(WebSettings.ZoomDensity.FAR);
//        mWebView.setInitialScale(35);
        mWebView.getSettings().setUseWideViewPort(true);

        mWebView.loadUrl("http://www.foxgarden.co.kr/");            // 웹뷰에서 불러올 URL 입력
        mWebView.invalidate();

        FirebaseMessaging.getInstance().subscribeToTopic("news");

        Log.d("token", FirebaseInstanceId.getInstance().getToken());
    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (event.getAction() == KeyEvent.ACTION_DOWN) {
            switch (keyCode) {
                case KeyEvent.KEYCODE_BACK:
                    if (mWebView.canGoBack()) {
                        mWebView.goBack();
                    } else {
                        finish();
                    }
                    return true;
            }

        }
        return super.onKeyDown(keyCode, event);
    }
}
