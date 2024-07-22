export function convertToISO(dateString) {
    const isoString = dateString.replace(' ', 'T');
    return new Date(isoString);
  }
  
  // Función para formatear la fecha
  export function formatDate(date, locale = 'es-ES', options = {}) {
    const d = convertToISO(date);
    return d.toLocaleDateString(locale, options);
  }
  
  // Función para formatear la hora
  export function formatTime(date, locale = 'es-ES', options = {}) {
    const d = convertToISO(date);
    return d.toLocaleTimeString(locale, options);
  }
  