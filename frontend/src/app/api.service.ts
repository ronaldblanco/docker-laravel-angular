import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'http://localhost:8000/api/projects'; // Replace with your API URL

  constructor(private http: HttpClient) { }

  getData(offset = 0,limit = 100,member = null): Observable<any> {
    return this.http.get(this.apiUrl + "?offset=" + offset + "&limit=" + limit + (member?"&member=" + member:""));
  }
}
