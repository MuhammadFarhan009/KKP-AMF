from flask import Flask, render_template
import requests
import os
from dotenv import load_dotenv

# Load environment variables from .env file
load_dotenv()

app = Flask(__name__)

@app.route('/')
def index():
    api_url = "https://webapi.bps.go.id/v1/api/list/model/var/domain/1100/key/"
    api_key = os.getenv('ACCESS_KEY')
    
    # Construct the full URL with the API key
    full_url = f"{api_url}{api_key}"
    # print(full_url)
    response = requests.get(full_url)
    data = response.json()
    
    # Assuming the data you need is in 'title' and 'sub_name' keys
    # title = data.get('title')
    # sub_name = data.get('sub_name')
    # Extract title and sub_name from the nested data list
    titles_and_subnames = []
    if 'data' in data and isinstance(data['data'], list) and len(data['data']) > 1 and isinstance(data['data'][1], list):
        for item in data['data'][1]:
            title = item.get('title')
            sub_name = item.get('sub_name')
            if title and sub_name:
                titles_and_subnames.append({'title': title, 'sub_name': sub_name})
    # return render_template('index.html', title=title, sub_name=sub_name, full_url=full_url)
    return render_template('index.html', items=titles_and_subnames)

if __name__ == '__main__':
    app.run(debug=True, port=6100)
