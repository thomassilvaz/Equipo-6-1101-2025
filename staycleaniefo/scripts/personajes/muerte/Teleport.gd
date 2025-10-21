extends State
 
var can_transition: bool = false
@onready var fx_player = %AudioStreamPlayer2D
 
func enter():
	super.enter()
	animation_player.play("skill")
	await animation_player.animation_finished
	can_transition = true
 
func sonido():
	var chance = randi() % 4
	match chance:
		1:
			var fx_stream = load("res://Audio/FX/laugh1.ogg")
			fx_player.stream = fx_stream
		2:
			var fx_stream = load("res://Audio/FX/laugh2.ogg")
			fx_player.stream = fx_stream
		3:
			var fx_stream = load("res://Audio/FX/laugh3.ogg")
			fx_player.stream = fx_stream
		4:
			var fx_stream = load("res://Audio/FX/laugh4.ogg")
			fx_player.stream = fx_stream

	fx_player.play()

func teleport():
	owner.position = player.position + Vector2.RIGHT * 120


func transition():
	if can_transition:
		get_parent().change_state("Attack")
		can_transition = false
