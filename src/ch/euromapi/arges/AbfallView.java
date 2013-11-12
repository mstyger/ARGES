package ch.euromapi.arges;

import android.app.ListActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

public class AbfallView extends ListActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.abfall_view);

		// storing string resources into Array
		String[] abfalltypen = getResources().getStringArray(
				R.array.abfalltypen);

		// Binding resources Array to ListAdapter
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,
				android.R.layout.simple_list_item_1, abfalltypen);

		// Assign adapter to List
		setListAdapter(adapter);
	}

	@Override
	protected void onListItemClick(ListView l, View v, int position, long id) {

		super.onListItemClick(l, v, position, id);

		// ListView Clicked item index
		int itemPosition = position;

		// ListView Clicked item value
		String itemValue = (String) l.getItemAtPosition(position);

		Toast.makeText(getApplicationContext(), itemPosition + " " + itemValue,
				Toast.LENGTH_LONG).show();

	}

}
