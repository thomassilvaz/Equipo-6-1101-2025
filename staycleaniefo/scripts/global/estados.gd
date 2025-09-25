extends Node

var introduccion:= true
var vendedor_bath1 := false

var game_data = {
	"played_cutscenes": {},
	"player_position": {"x": 0, "y": 0},
}

func _ready():
	load_game()

func mark_cutscene_played(cutscene_id):
	game_data["played_cutscenes"][cutscene_id] = true
	save_game()

func has_played_cutscene(cutscene_id):
	return game_data["played_cutscenes"].get(cutscene_id, false)

func save_game():
	var json_string = JSON.stringify(game_data)
	var file = FileAccess.open("user://savegame.json", FileAccess.WRITE)
	
	if file:
		file.store_string(json_string)
		file.close()
		print("Game saved successfully!")
	else:
		push_error("Could not save game data.")

func load_game():
	if not FileAccess.file_exists("user://savegame.json"):
		print("No save file found. Starting new game.")
		return
	
	var file = FileAccess.open("user://savegame.json", FileAccess.READ)
	if file:
		var json_string = file.get_as_text()
		file.close()
		
		var json = JSON.new()
		var error = json.parse(json_string)
		
		if error == OK:
			var loaded_data = json.get_data()
			if loaded_data is Dictionary:
				game_data = loaded_data
				print("Game loaded successfully!")
			else:
				push_error("Loaded data is not a dictionary.")
		else:
			push_error("JSON Parse Error: " + json.get_error_message())
	else:
		push_error("Could not load game data.")
