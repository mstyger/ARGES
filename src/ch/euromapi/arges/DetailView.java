package ch.euromapi.arges;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;

public class DetailView extends Activity {
	private String gemeinde;
	private String abfalltyp;
	private ProgressDialog mPg;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.detail_view);

		Intent intent = getIntent();
		this.gemeinde = intent.getStringExtra("gemeinde");
		this.abfalltyp = intent.getStringExtra("abfalltyp");
		
		mPg = ProgressDialog.show(this, "Lade Daten", "Informationen werden geladen.");
		
		final WebView wv = (WebView) findViewById(R.id.webview);
		String uri = "http://www.down.ch/Abfallkalender/serviceAbfalllocation.php?ort=" + gemeinde
				+ "&abfalltype=" + abfalltyp;
		
		wv.setWebViewClient(new WebViewClient() {
			public void onPageFinished(WebView view, String url) {
				mPg.dismiss();
			}
		});
		
		wv.loadUrl(uri);
	}
	
	@Override
	public void onBackPressed() {
		if (mPg != null) {
			mPg.dismiss();
		}
		super.onBackPressed();
	}
}
