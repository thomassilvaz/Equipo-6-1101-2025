extends Area2D

@export var cutscene_controller_path: NodePath
@export var escena_a_detectar: String
var escena_hecha: bool

#obtiene el valor de la variable global seleccionada en el inspector
func _ready() -> void:
	if Estados.get(escena_a_detectar) != null:
		escena_hecha = Estados.get(escena_a_detectar)

#activa o ignora la escena segun el valor de la variable
func _on_body_entered(body: Node2D) -> void:
	if body is Jugador:
		if !escena_hecha:
			print("Escena no esta hecha")
			var cutscene_controller = get_node(cutscene_controller_path)
			if cutscene_controller and cutscene_controller.has_method("start_cutscene"):
				cutscene_controller.start_cutscene()
				set_deferred("monitoring", false)
				
				Estados.set(escena_a_detectar, true)
				escena_hecha = true
			else:
				push_error("Cutscene controller not found or missing start_cutscene method")
		else:
			print("La escena esta hecha")

#ADVERTENCIAS
#si cada que se abre la escene la animacion se reproduce, aleja al JUGADOR de los TRIGGERS
#si la animación no corre, añadir Node signal "on_body_entered" al Area2D
