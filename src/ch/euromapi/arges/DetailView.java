package ch.euromapi.arges;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.webkit.WebView;

public class DetailView extends Activity {
	private String gemeinde;
	private String abfalltyp;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.detail_view);
		
		Intent intent = getIntent();
		this.gemeinde = intent.getStringExtra("gemeinde");
		this.abfalltyp = intent.getStringExtra("abfalltyp");
		
		final WebView wv = (WebView)findViewById(R.id.webview);
		String uri = "http://www.down.ch/service.php?ort=" + this.gemeinde + "&abfalltyp=" + this.abfalltyp;
		wv.loadUrl(uri);
	}

}
