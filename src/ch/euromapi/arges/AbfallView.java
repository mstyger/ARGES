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

public class AbfallView extends ListActivity {
	private String mGemeinde;
	private ProgressDialog mPg;
	private JsonParser mJparser;
	private JSONObject mJsonResponse;
	private ArrayList<String> mAbfalltypen;
	
private static final String SERVICE_URL = "http://www.down.ch/Abfallkalender/serviceAbfalllTyp.php?ort=";
	
	private class JsonCall extends AsyncTask<URL, Void, String> {
		@Override
		protected String doInBackground(URL... urls) {
			mJsonResponse = mJparser.getJSONFromUrl(SERVICE_URL + mGemeinde);
			try {
				JSONArray abfalltypen = mJsonResponse.getJSONArray("abfalltypes");
				JSONObject abfalltyp;
				for (int i=0; i<abfalltypen.length(); i++) {
					abfalltyp = abfalltypen.getJSONObject(i);
					mAbfalltypen.add(abfalltyp.getString("name"));
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
		setContentView(R.layout.abfall_view);
		
		Intent intent = getIntent();
		mGemeinde = intent.getStringExtra("gemeinde");
		
		mJparser = new JsonParser();
		mAbfalltypen = new ArrayList<String>();

		setTitle("Abfalltyp wählen");
		
		loadData();
	}
	
	private void loadData() {
		mPg = ProgressDialog.show(this, "Lade Daten", "Abfalltypen verden gesucht.");
		new JsonCall().execute();
	}

	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {

		super.onListItemClick(l, v, position, id);

		// ListView Clicked item value
		String itemValue = (String) l.getItemAtPosition(position);
		
		Intent intent = new Intent(this, DetailView.class);
	    intent.putExtra("gemeinde", mGemeinde);
	    intent.putExtra("abfalltyp", itemValue);
	    startActivity(intent);

	}
	
	public void showData() {
		// Binding resources Array to ListAdapter

		String[] abfalltypen = new String[mAbfalltypen.size()];
		for (int i = 0; i < mAbfalltypen.size(); i++) {
			abfalltypen[i] = (String) mAbfalltypen.get(i);
		}
		
		if(abfalltypen.length == 0){
			Toast.makeText(getApplicationContext(), "Keine Daten gefunden.",
					   Toast.LENGTH_LONG).show();
		}
		
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
				android.R.layout.simple_list_item_1, abfalltypen);
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
