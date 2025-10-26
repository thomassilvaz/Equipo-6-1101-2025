extends State

@onready var collision = $"../../PlayerDetection/CollisionShape2D"
@onready var progress_bar = owner.find_child("ProgressBar")
 
#variable cuya valor cambia más variables
var player_entered: bool = false:
	set(value):
		player_entered = value
		collision.set_deferred("disabled", value)
		progress_bar.set_deferred("visible",value)
 
#marca que el jugador ya esta en el area para iniciar el boss
func _on_player_detection_body_entered(body):
	if body is Jugador:
		player_entered = true

#cambia de inmediato al estado de seguir al jugador
func transition():
	if player_entered:
		get_parent().change_state("Follow")
