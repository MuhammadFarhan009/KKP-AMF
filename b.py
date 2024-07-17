import requests
# import pandas as pd

# Define the API endpoint
# api_url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/9/key/e437040ac2bc6886742a0bfab5a46355/"
api_url = "https://webapi.bps.go.id/v1/api/list/model/statictable/domain/1100/key/e437040ac2bc6886742a0bfab5a46355/"

# Make a GET request to the API
response = requests.get(api_url)

# Check if the request was successful
if response.status_code == 200:
    # Parse the JSON response
    data = response.json()
    print("API Response:", data)
    
    # Extract relevant data (assuming the data you need is in the 'data' key)
    # if '9' in data:
    #     df = pd.DataFrame(data['9'])
    #     print(df)
    # else:
    #     print("The 'data' key was not found in the response.")
else:
    print("Failed to retrieve data. Status code:", response.status_code)
