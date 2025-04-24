export function handleServerErrors(error, v$) {
    if (error.response && error.response.status === 422) {
      const serverErrors = error.response.data.errors
      for (const [field, messages] of Object.entries(serverErrors)) {
        if (v$[field]) {
          v$[field].$errors.push(...messages.map(message => ({ $message: message })))
          v$[field].$invalid = true
        }
      }
    }
  }
