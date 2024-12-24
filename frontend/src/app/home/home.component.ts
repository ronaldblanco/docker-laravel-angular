import { Component, OnInit, Input, OnChanges, SimpleChanges, DoCheck } from '@angular/core';
import { ApiService } from '../api.service';

let projectsTemplate = `
<section>

<!-- Dynamic content updates when not selectedItem changes -->
<div *ngIf="!selectedItem">
<h2>{{member!=''?member + "'s ":"All "}}Projects Information:</h2>

<form>
  <input type="text" placeholder="Filter by Member Name" [(ngModel)]="member" name="memberSearch">
  <!-- <button class="primary" type="button" (click)="onSearch(member)">Search</button> -->
</form>

<table class="styled-table">
  <thead>
    <tr>
      <th>Projects</th>
      <th>Members</th>
      <th>Estimate Hours</th>
      <th>Description</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <tr *ngFor="let item of filterData()">
    <td>{{ item.name }}</td>
    <td>{{ item.memberList }}</td>
    <td>{{ item.hours }}</td>
    <td>{{ item.description }}</td>
    <td>
        <button type="button" id="{{item.id}}" (click)="viewTasksDetails(item)">View</button>
    </td>
  </tr>
</tbody>
</table>
</div>

<!-- Dynamic content updates when selectedItem changes -->
<div *ngIf="selectedItem">  
  <h2>Details for {{ selectedItem.name }}, total hours duration {{ selectedItem.hours }} and tasks hours {{calculateTotalTime()}}</h2>  
  <table class="styled-table">
  <thead>
    <tr>
      <th>Task</th>
      <th>Assigned To</th>
      <th>Estimate Hours</th>
      <th>Description</th>      
    </tr>
  </thead>
  <tbody>
  <tr *ngFor="let item of selectedItem.tasks">
    <td>{{ item.task }}</td>
    <td>{{ item.member.name }}</td>
    <td>{{ item.hours }}</td>
    <td>{{ item.description }}</td>    
  </tr>
</tbody>
</table>
<button type="button" (click)="closeTasksDetails()">Back</button>
</div>

</section>
`;

@Component({
  selector: 'app-home',
  template: projectsTemplate,
  styleUrls: ['./home.component.css']
})

export class HomeComponent implements OnInit, DoCheck {

  data: any = [];
  selectedItem: any = null;
  member: string = '';
  memberOld: string = '';

  ngDoCheck(): void {
    // You can compare the previous value with the current one
    if (this.member !== this.memberOld && (this.member.length > 2 || this.member == '')) {
      this.memberOld = this.member;  // Update the previous value
      console.log('The variable has changed:', this.member);
      this.fetchData(0,100,this.member != ""?this.member:null);
    }
  }

  constructor(private apiService: ApiService) { }

  ngOnInit(): void {
    this.fetchData(0,100);
  }

  fetchData(offset = 0,limit = 100, member = null): void {
    this.apiService.getData(offset,limit,member).subscribe({
      next: (response) => {        
        console.log('Data fetched:', response); 

        this.data = response.map(item => ({
          ...item,
          memberList: item.members.map(member => member.name).join(", ")
        }));

        console.log('Data fetched edited:', this.data);
      },
      error: (err) => {
        console.error('Error fetching data:', err);
      }
    });
  }

  viewTasksDetails(item: any): void {
    this.selectedItem = item;
    console.log('Selected Item:', item);
  }

  closeTasksDetails(): void {
    this.selectedItem = null;
    console.log('Selected Item:', this.selectedItem);
  }

  // Component (TypeScript)
  calculateTotalTime(): number {
    if (!this.selectedItem || !Array.isArray(this.selectedItem.tasks)) {
      return 0; // Return 0 if selectedItem or tasks array is invalid
    }
    return this.selectedItem.tasks.reduce((acc, task) => acc + (task.hours || 0), 0);
  }

  onSearch(value: string): void {
    console.log('Search triggered with value:', value);
    this.member = value;
    // Add your search logic here
  }
  
  filterData<T>(): T[] {
    return this.member?this.data.filter((project)=>project.memberList.toLowerCase().includes(this.member.toLowerCase())):this.data;
  }

}
