import requests
import json
# Define the API endpoint
# api_url = "https://webapi.bps.go.id/v1/api/domain/type/prov/key/e437040ac2bc6886742a0bfab5a46355/"
# api_url = "https://webapi.bps.go.id/v1/api/domain/type/prov/key/e437040ac2bc6886742a0bfab5a46355/"
# api_url = "https://webapi.bps.go.id/v1/api/domain/type/kabbyprov/prov/1100/key/e437040ac2bc6886742a0bfab5a46355/"
api_url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/1100/var/9/key/e437040ac2bc6886742a0bfab5a46355/"


# Make a GET request to the API
response = requests.get(api_url)

# Check if the request was successful
if response.status_code == 200:
    # Parse the JSON response
    data = response.json()
    
    # Check for the expected keys in the response
    if data.get("status") == "OK" and data.get("data-availability") == "available":
        # Access the nested data
        pagination_info = data["data"][0]
        domains = data["data"][1]
        
        # Print the parsed information
        print("Pagination Info:", json.dumps(pagination_info, indent=4))
        print("Domains:", json.dumps(domains, indent=4))
        
        # Convert the parsed JSON response to a JSON string
        json_data = json.dumps(data, indent=4)
        
        # Save the JSON data to a file
        # with open('api_response.json', 'w') as json_file:
        #     json_file.write(json_data)
        
        print("API response has been saved to api_response.json")
    else:
        print("Data is not available or status is not OK.")
else:
    print("Failed to retrieve data. Status code:", response.status_code)