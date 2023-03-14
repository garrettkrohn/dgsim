import { coursesNamesResource } from './DTOs';

export async function getAllCourseNames(): Promise<coursesNamesResource[]> {
  return await fetch(`http://localhost:8000/api/courses/names`, {
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
