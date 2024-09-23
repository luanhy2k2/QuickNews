import { Component } from '@angular/core';
import { Approval, Article } from 'src/app/Models/Article/article';
import { UpsertArticle } from 'src/app/Models/Article/upsert-article';
import { BasePaging } from 'src/app/Models/Common/base-paging';
import { BaseQuerieResponse } from 'src/app/Models/Common/base-querie-response';
import { ArticleService } from 'src/app/Services/article.service';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { HttpClient } from '@angular/common/http';
import { Category } from 'src/app/Models/Category/category';
import { CategoryService } from 'src/app/Services/category.service';
import { TagService } from 'src/app/Services/tag.service';
import { Tag } from 'src/app/Models/Tag/tag';

@Component({
  selector: 'app-user-article',
  templateUrl: './user-article.component.html',
  styleUrls: ['./user-article.component.scss'],
})
export class UserArticleComponent {
  constructor(
    private readonly ArticleService: ArticleService,
    private readonly categoryService: CategoryService,
    private readonly tagService:TagService
  ) {}
  Article: BaseQuerieResponse<Article> = {
    pageIndex: 1,
    pageSize: 10,
    keyword: '',
    item: [],
    total: 0,
  };
  Category: BaseQuerieResponse<Category> = {
    pageIndex: 1,
    pageSize: 10,
    item: [],
    total: 0,
    keyword: '',
  };
  tag:BaseQuerieResponse<Tag> = {
    pageIndex:1,
    pageSize:30,
    keyword:"",
    item:[],
    total:0
  };
  public Editor = ClassicEditor;
  public editorConfig = {
    // Cấu hình plugin
    toolbar: [
      'heading',
      '|',
      'bold',
      'italic',
      'link',
      'imageUpload',
      '|',
      'undo',
      'redo'
    ],
    image: {
      toolbar: [
        'imageTextAlternative',
        '|',
        'imageStyle:full',
        'imageStyle:side'
      ]
    },
    // Thêm các cấu hình khác nếu cần
  };
  tottalPageArray: number[] = [];
  upsertArticleReq: UpsertArticle = {
    title: '',
    summary: '',
    content: '',
    articleTags:[],
    category_id: '',
    approval: Approval.Pending,
    avatar: '',
  };
  idArticleSelected:string = "";
  avatarArticleReq: File = new File([''], '');
  onAvatarChanged(event: any) {
    this.avatarArticleReq = event.target.files[0];
  }
  isModalCreate: boolean = true;
  ngOnInit() {
    this.loadArticle();
    this.loadCategory();
    this.loadTag();
  }
  public onFileUpload(event: any) {
    const files = event.target.files;
    if (files.length > 0) {
      const file = files[0];
      const reader = new FileReader();
      reader.onload = () => {
        const imgHTML = `<img src="${reader.result}" class="uploaded-image" alt="Uploaded Image" />`;
        this.upsertArticleReq.content += imgHTML;
      };
      reader.readAsDataURL(file);
    }
  }

  onReady(editor: any) {
    editor.plugins.get('FileRepository').createUploadAdapter = (
      loader: any
    ) => {
      return new MyUploadAdapter(loader);
    };
  }
  save() {
    if (this.isModalCreate) {
      this.create();
    } else {
      this.update();
    }
  }

  create() {
    this.ArticleService.UploadFileArticle(this.avatarArticleReq).subscribe((res) => {
      if (res.success) {
        this.upsertArticleReq.avatar = res.object;
        this.ArticleService.create(this.upsertArticleReq).subscribe((res) => {
          if (res.success) {
            this.Article.item.unshift(res.object);
          }
          alert(res.message);
        });
        this.resetAvatarArticleReq();
      }
    });
  }

  update() {
    const updateArticle = (avatar?: string) => {
      if (avatar) {
        this.upsertArticleReq.avatar = avatar;
      }
      this.ArticleService.update(this.idArticleSelected,this.upsertArticleReq).subscribe((res) => {
        this.loadArticle();
        alert(res.message);
      });
    };

    if (this.avatarArticleReq.size > 0) {
      this.ArticleService.UploadFileArticle(this.avatarArticleReq).subscribe((res) => {
        if (res.success) {
          updateArticle(res.object);
        }
      });
    } else {
      updateArticle();
    }
  }

  resetAvatarArticleReq() {
    this.avatarArticleReq = new File([''], '');
  }

  onOptionSelect(event: Event) {
    const selectElement = event.target as HTMLSelectElement;
    const optionId = selectElement.value;
    const selectedTag = this.tag.item.find((tag: Tag) => tag.id == optionId);
    if (selectedTag && !this.upsertArticleReq.articleTags.some(tag => tag.id == selectedTag.id)) {
      this.upsertArticleReq.articleTags.push(selectedTag);
    }
  }


  removeOption(index: number) {
    this.upsertArticleReq.articleTags.splice(index, 1);
  }
  loadArticle() {
    const paging: BasePaging = {
      pageIndex: this.Article.pageIndex,
      pageSize: this.Article.pageSize,
      keyword: this.Article.keyword,
    };
    this.ArticleService.getArticles(paging).subscribe((res) => {
      var toatlPage = Math.ceil(res.total / res.pageSize);
      this.tottalPageArray = Array.from(
        { length: toatlPage },
        (_, index) => index + 1
      );
      this.Article = res;
      console.log("ar", res)
    });
  }
  loadCategory() {
    const paaging: BasePaging = {
      pageIndex: this.Category.pageIndex,
      pageSize: this.Category.pageSize,
      keyword: this.Category.keyword,
    };
    this.categoryService.getCategory(paaging).subscribe((res) => {
      this.Category = res;
    });
  }
  loadTag(){
    const paging: BasePaging = {
      pageIndex: this.Article.pageIndex,
      pageSize: this.Article.pageSize,
      keyword: this.Article.keyword,
    };
    this.tagService.getTag(paging).subscribe(res =>{
      this.tag = res;
    })
  }
  nextPage() {
    this.Article.pageIndex++;
    if (this.Article.pageIndex > this.tottalPageArray.length + 1) {
      this.Article.pageIndex = this.tottalPageArray.length + 1;
    }
    this.loadArticle();
  }
  previousPage() {
    this.Article.pageIndex--;
    if (this.Article.pageIndex == 0) {
      this.Article.pageIndex = 1;
    }
  }
  setPage(pageInDex: number) {
    this.Article.pageIndex = pageInDex;
    this.loadArticle();
  }
  getArticleById(article: Article) {
    this.isModalCreate = false;
    this.idArticleSelected = article.id;
    this.upsertArticleReq = article;
  }
  delete(id: string) {
    const isConfirmed = confirm('Bạn có chắc muốn xoá không?');
    if (isConfirmed) {
      this.ArticleService.delete(id).subscribe((res) => {
        if (res.success == true) {
          const index = this.Article.item.findIndex((c) => c.id == res.object);
          if (index !== -1) {
            this.Article.item.splice(index, 1);
          }
        }
        alert(res.message);
      });
    }
  }
}
class MyUploadAdapter {
  loader: any;
  uploadedFileUrl: string | null = null;
  constructor(loader: any) {
    this.loader = loader;
  }
  upload() {
    return new Promise((resolve, reject) => {
      const data = new FormData();
      this.loader.file.then((file: any) => {
        data.append('file', file);
        this.uploadImage(data)
          .then((response: any) => {
            resolve({ default: response.object }); // Trả về URL ảnh
          })
          .catch((error: any) => {
            reject(error);
          });
      });
    });
  }
  uploadImage(formData: FormData) {
    return fetch('http://localhost:8000/api/article/upload', {
      method: 'POST',
      body: formData,
    }).then((response) => response.json());
  }

  // abort() {
  //   if (this.uploadedFileUrl) {
  //     this.deleteFile(this.uploadedFileUrl)
  //       .then(() => {
  //         console.log('File deleted successfully');
  //       })
  //       .catch((error) => {
  //         console.error('Error deleting file:', error);
  //       });
  //   }
  // }

  // deleteFile(url: string) {
  //   return fetch('http://localhost:8000/api/article/deleteFile', {
  //     method: 'POST',
  //     headers: {
  //       'Content-Type': 'application/json',
  //     },
  //     body: JSON.stringify({ url }), // Gửi URL file cần xóa
  //   }).then((response) => response.json());
  // }
}
