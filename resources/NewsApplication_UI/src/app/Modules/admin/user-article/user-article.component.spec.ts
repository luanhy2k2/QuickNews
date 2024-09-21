import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UserArticleComponent } from './user-article.component';

describe('UserArticleComponent', () => {
  let component: UserArticleComponent;
  let fixture: ComponentFixture<UserArticleComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [UserArticleComponent]
    });
    fixture = TestBed.createComponent(UserArticleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
