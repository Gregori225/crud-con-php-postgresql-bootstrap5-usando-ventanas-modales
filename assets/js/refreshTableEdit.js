// Define la función globalmente adjuntándola al objeto window
window.actualizarEmpleadoEdit = async function (idUsuario) {
  try {
    const response = await axios.get(
      `acciones/getEmpleado.php?id=${idUsuario}`
    );
    
    if (response.status === 200 && !response.data.error) {
      const infoUsuario = response.data; // Obtener los datos del usuario desde la respuesta

      // Buscar la fila correcta con el prefijo usuario_ (no empleado_)
      let tr = document.querySelector(`#usuario_${idUsuario}`);
      
      if (!tr) {
        console.error("No se encontró la fila del usuario en la tabla");
        return;
      }

      let nuevaFilaHTML = `
          <th class="dt-type-numeric sorting_1" scope="row">${infoUsuario.id}</th>
          <td>${escapeHtml(infoUsuario.nombre)}</td>
          <td>${escapeHtml(infoUsuario.usuario)}</td>
          <td><span class="badge bg-info text-dark">${escapeHtml(infoUsuario.rol)}</span></td>
          <td>${escapeHtml(infoUsuario.cargo)}</td>
          <td>${escapeHtml(infoUsuario.departamento || 'N/A')}</td>
          <td>
            ${infoUsuario.activo 
              ? '<span class="badge bg-success">Activo</span>' 
              : '<span class="badge bg-danger">Inactivo</span>'}
          </td>
          <td>
            <a title="Ver detalles del usuario" href="#" onclick="verDetallesEmpleado(${infoUsuario.id})" class="btn btn-success btn-sm">
              <i class="bi bi-binoculars"></i>
            </a>
            <a title="Editar datos del usuario" href="#" onclick="editarEmpleado(${infoUsuario.id})" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil-square"></i>
            </a>
            <a title="Eliminar datos del usuario" href="#" onclick="eliminarEmpleado(${infoUsuario.id})" class="btn btn-danger btn-sm">
              <i class="bi bi-trash"></i>
            </a>
          </td>
        `;

      // Actualizar el contenido HTML de la fila
      tr.innerHTML = nuevaFilaHTML;
    } else {
      console.error("Error en la respuesta del servidor:", response.data);
    }
  } catch (error) {
    console.error("Error al obtener la información del usuario", error);
  }
};

/**
 * Función auxiliar para escapar HTML y prevenir XSS
 */
function escapeHtml(text) {
  if (!text) return '';
  const map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
