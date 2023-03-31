import { coursesNamesResource } from './DTOs';

export async function getAllCourseNames(): Promise<coursesNamesResource[]> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/courses/names`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: coursesNamesResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
