package ch.euromapi.arges;

import java.net.URL;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;
import ch.euromapi.arges.util.JsonParser;

public class MainActivity extends ListActivity {
	private ProgressDialog mPg;
	private JsonParser mJparser;
	private JSONObject mJsonResponse;
	private ArrayList<String> mGemeinden;

	private static final String SERVICE_URL = "http://www.down.ch/Abfallkalender/servicePlace.php";
	
	private class JsonCall extends AsyncTask<URL, Void, String> {
		@Override
		protected String doInBackground(URL... urls) {
			mJsonResponse = mJparser.getJSONFromUrl(SERVICE_URL);
			try {
				JSONArray gemeinden = mJsonResponse.getJSONArray("places");
				JSONObject gemeinde;
				for (int i=0; i<gemeinden.length(); i++) {
					gemeinde = gemeinden.getJSONObject(i);
					mGemeinden.add(gemeinde.getString("name"));
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}
			return "done";
		}

		@Override
		protected void onPostExecute(String result) {
			showData();
		}
	}
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);

		mJparser = new JsonParser();
		mGemeinden = new ArrayList<String>();

		setTitle("Gemeinde wählen");
		
		loadData();
	}

	private void loadData() {
		mPg = ProgressDialog.show(this, "Lade Daten", "Gemeinden verden gesucht.");
		new JsonCall().execute();
	}

	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {

		super.onListItemClick(l, v, position, id);

		// ListView Clicked item value
		String itemValue = (String) l.getItemAtPosition(position);

		Intent intent = new Intent(this, AbfallView.class);
		intent.putExtra("gemeinde", itemValue);
		startActivity(intent);

	}

	public void showData() {
		// Binding resources Array to ListAdapter

		String[] gemeinden = new String[mGemeinden.size()];
		for (int i = 0; i < mGemeinden.size(); i++) {
			gemeinden[i] = (String) mGemeinden.get(i);
		}
		
		if(gemeinden.length == 0){
			Toast.makeText(getApplicationContext(), "Keine Daten gefunden.",
					   Toast.LENGTH_LONG).show();
		}
		
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
				android.R.layout.simple_list_item_1, gemeinden);
		// Assign adapter to List
		setListAdapter(adapter);
		mPg.dismiss();
	}

	@Override
	public void onBackPressed() {
		if (mPg != null) {
			mPg.dismiss();
		}
		super.onBackPressed();
	}
}
