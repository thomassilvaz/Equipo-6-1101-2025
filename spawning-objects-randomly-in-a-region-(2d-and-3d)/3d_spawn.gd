extends Node3D

#region Random Position Part 1: Declaring Two Points
var point_1: Vector3
var point_2: Vector3
#endregion

#region Spawning Objects Part 1: Saving the Object Blueprint
@onready var powerup_blueprint: Resource = preload("res://godot_powerup_3d.tscn")
#endregion

#region Random Position Part 1b: Defining Two Points
func _ready():
	randomize() #this function ensures every playthrough is different
	point_1 = $Visualizer3D/Point1.position
	point_2 = $Visualizer3D/Point2.position
#endregion

#region Random Position Part 2: Writing a Function
func get_random_point_inside(p1: Vector3, p2: Vector3) -> Vector3:
#region Part 2a: Getting Random x, y, and z-values
	var x_value: float = randf_range(p1.x, p2.x)
	var y_value: float = randf_range(p1.y, p2.y)
	var z_value: float = randf_range(p1.z, p2.z)
#endregion
	
#region Part 2b: Putting Together the Point
	var random_point_inside: Vector3 = Vector3(x_value, y_value, z_value)
#endregion

#region Part 2c: Returning the Point
	return(random_point_inside)
#endregion

#endregion

#region Spawning Objects Part 2: Writing a Function
func spawn_powerup():
#region Part 2a: Build and Place the Powerup
	#builds the powerup behind the scenes
	var powerup_instance: Node = powerup_blueprint.instantiate()
	#places the powerup in our scene tree so we can see it
	add_child(powerup_instance)
#endregion
#region Part 2b: Setting the Position
	#Uses our function to generate a random spawn location
	var spawn_location: Vector3 = get_random_point_inside(point_1, point_2)
	#Sets the position to the random spawn location
	powerup_instance.position = spawn_location
#endregion
#endregion


func _process(_delta):
	#Every time we press the left mouse button, we spawn a powerup.
	if Input.is_action_just_pressed("lmb"):
		spawn_powerup()
