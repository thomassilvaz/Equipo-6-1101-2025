extends State
 
var can_transition: bool = false
@onready var fx_player = %AudioStreamPlayer2D


func enter():
	super.enter() #accede la funcion de entrar en estado desde el script extendido
	animation_player.play("skill") #activa la animacion de teletransporte
	await animation_player.animation_finished
	can_transition = true #al acabarse, puede salir del estado

#al llamarse, activa una risa aleatoria
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
	var random_angle = randf() * 2 * PI #genera un angulo circular aleatorio
	# crea un vector del angulo
	var random_direction = Vector2(cos(random_angle), sin(random_angle))
	owner.position = player.position + random_direction * 120 #se teletransporta al jugador segun el angulo escogido

#cambia el estado de ataque si se cumple la condicion
func transition():
	if can_transition:
		get_parent().change_state("Attack")
		can_transition = false
